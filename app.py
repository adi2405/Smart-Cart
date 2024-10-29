from flask import Flask, request, redirect, session, url_for
from google.oauth2 import id_token
from google.auth.transport import requests
import matplotlib
matplotlib.use('Agg')
from flask import Flask, request, jsonify, send_file
import pandas as pd
import pickle
from sklearn.cluster import KMeans
import matplotlib.pyplot as plt
import scipy.cluster.hierarchy as sch
from sklearn.preprocessing import StandardScaler
from sklearn.cluster import AgglomerativeClustering
import os

app = Flask(__name__)

CLIENT_ID = "450726384001-l075m6t166ijfc1mb5ufhnppklni8su0.apps.googleusercontent.com"

# Load the pre-trained KMeans model and scaler
with open('models_pkl/kmeans_model.pkl', 'rb') as model_file:
    kmeans = pickle.load(model_file)

with open('models_pkl/scaler_kmeans.pkl', 'rb') as scaler_file:
    scaler = pickle.load(scaler_file)

# Load the pre-trained Hierarchical Clustering model and scaler
with open('models_pkl/hierarchical_model.pkl', 'rb') as model_file:
    hierarchical_model = pickle.load(model_file)

with open('models_pkl/scaler_hierarchical.pkl', 'rb') as scaler_file:
    scaler = pickle.load(scaler_file)

@app.route('/predict_kmeans', methods=['POST'])
def predict_kmeans():
    if 'file' not in request.files:
        return jsonify({'error': 'No file part'}), 400

    file = request.files['file']
    
    # Load the dataset from the uploaded file
    dataset = pd.read_excel(file)
    
    # Select the relevant features
    features = dataset[['Sales', 'Profit', 'Quantity', 'Discount']]
    
    # Scale the features
    scaled_features = scaler.transform(features)
    
    # Predict clusters
    clusters = kmeans.predict(scaled_features)
    
    # Add cluster assignment to the dataset
    dataset['Cluster'] = clusters
    
    # Identify the most profitable cluster
    cluster_profit = dataset.groupby('Cluster')['Profit'].mean()
    most_profitable_cluster = cluster_profit.idxmax()

    # Get all products from the most profitable cluster
    profitable_products = dataset[dataset['Cluster'] == most_profitable_cluster]

    # Sort products by profit in descending order
    profitable_products = profitable_products.sort_values(by='Profit', ascending=False)

    # Remove duplicate products, keeping the one with the highest profit
    profitable_products = profitable_products.drop_duplicates(subset='Product ID', keep='first')

    # Select the top 3 profitable products
    top_3_products = profitable_products.head(3)
    
    # Handle missing image URLs by assigning a default image URL
    default_image_url = "https://via.placeholder.com/150"
    dataset['Product Image'] = dataset['Product Image'].fillna(default_image_url)
        
    # Save the Elbow plot image
    static_folder = 'static'
    elbow_img_path = os.path.join(static_folder, 'elbow_plot_kmeans.png')
    if not os.path.exists(elbow_img_path):
        # Generate and save the Elbow graph
        wcss = []
        for i in range(1, 11):
            kmeans_elbow = KMeans(n_clusters=i, init='k-means++', max_iter=300, n_init=10, random_state=42)
            kmeans_elbow.fit(scaled_features)
            wcss.append(kmeans_elbow.inertia_)
        
        plt.figure(figsize=(10, 6))
        plt.plot(range(1, 11), wcss, marker='o')
        plt.title('Elbow Method for Optimal Number of Clusters')
        plt.xlabel('Number of Clusters')
        plt.ylabel('WCSS')
        plt.savefig(elbow_img_path)
        plt.close()
    
    # Save the second image (Clusters visualization)    
    cluster_img_path = os.path.join(static_folder, 'cluster_plot_kmeans.png')
    colors = ['purple', 'orange', 'green', 'blue', 'brown']
    
    plt.figure(figsize=(10, 6))
    for cluster in range(5):  # Assuming 5 clusters
        cluster_data = dataset[dataset['Cluster'] == cluster]
        plt.scatter(cluster_data['Sales'], cluster_data['Profit'], 
                    c=colors[cluster], label=f'Cluster {cluster}')
    
    # Plot the centroids
    plt.scatter(kmeans.cluster_centers_[:, 0], kmeans.cluster_centers_[:, 1], 
                s=100, c='red', label='Centroids')

    plt.title('Clusters of Sales and Profit')
    plt.xlabel('Sales')
    plt.ylabel('Profit')
    plt.legend()
    plt.savefig(cluster_img_path)
    plt.close()
    
    # Return the result along with the image paths
    return jsonify({
        'data': dataset.to_dict(orient='records'),
        'elbow_image': elbow_img_path,
        'cluster_image': cluster_img_path,
        'top_3_products': top_3_products[['Product ID', 'Product Name', 'Sales', 'Quantity', 'Discount', 'Profit', 'Product Image']].to_dict(orient='records')
    }), 200

@app.route('/predict_hierarchical', methods=['POST'])
def predict_hierarchical():
    if 'file' not in request.files:
        return jsonify({'error': 'No file part'}), 400

    file = request.files['file']

    # Load the dataset from the uploaded file
    dataset = pd.read_excel(file)

    # Select the relevant features
    features = dataset[['Sales', 'Profit', 'Quantity', 'Discount']]

    # Scale the features
    scaled_features = scaler.transform(features)

    # Generate and save the dendrogram plot
    dendrogram_img_path = 'static/dendrogram_plot.png'
    plt.figure(figsize=(10, 6))
    sch.dendrogram(sch.linkage(scaled_features, method='ward'))
    plt.title('Dendrogram for Optimal Number of Clusters')
    plt.xlabel('Data Points')
    plt.ylabel('Euclidean Distance')
    plt.savefig(dendrogram_img_path)
    plt.close()

    # Predict clusters using the pre-trained hierarchical model
    optimal_clusters = 5  # Based on the dendrogram analysis
    clusters = hierarchical_model.fit_predict(scaled_features)
    
    # Add cluster assignment to the dataset
    dataset['Cluster'] = clusters
    
    # Identify the most profitable cluster
    cluster_profit = dataset.groupby('Cluster')['Profit'].mean()
    most_profitable_cluster = cluster_profit.idxmax()

    # Get all products from the most profitable cluster
    profitable_products = dataset[dataset['Cluster'] == most_profitable_cluster]

    # Sort products by profit in descending order
    profitable_products = profitable_products.sort_values(by='Profit', ascending=False)

    # Remove duplicate products, keeping the one with the highest profit
    profitable_products = profitable_products.drop_duplicates(subset='Product ID', keep='first')

    # Select the top 3 profitable products
    top_3_products = profitable_products.head(3)
    
    # Handle missing image URLs by assigning a default image URL
    default_image_url = "https://via.placeholder.com/150"
    dataset['Product Image'] = dataset['Product Image'].fillna(default_image_url)

    # Save the second image (Cluster visualization using Sales and Profit)
    cluster_img_path = 'static/cluster_plot_hierarchical.png'
    colors = ['purple', 'orange', 'green', 'blue', 'brown']
    plt.figure(figsize=(10, 6))

    for cluster in range(optimal_clusters):
        cluster_data = dataset[dataset['Cluster'] == cluster]
        plt.scatter(cluster_data['Sales'], cluster_data['Profit'], 
                    c=colors[cluster], label=f'Cluster {cluster}')

    plt.title('Clusters of Sales and Profit')
    plt.xlabel('Sales')
    plt.ylabel('Profit')
    plt.legend()
    plt.savefig(cluster_img_path)
    plt.close()

    # Return the result along with the image paths
    return jsonify({
        'data': dataset.to_dict(orient='records'),
        'dendrogram_image': dendrogram_img_path,
        'cluster_image': cluster_img_path,
        'top_3_products': top_3_products[['Product ID', 'Product Name', 'Sales', 'Quantity', 'Discount', 'Profit', 'Product Image']].to_dict(orient='records')        
    }), 200

if __name__ == '__main__':
    app.run(debug=True)