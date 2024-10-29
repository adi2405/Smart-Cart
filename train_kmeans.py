import pandas as pd
from sklearn.preprocessing import StandardScaler
from sklearn.cluster import KMeans
import matplotlib.pyplot as plt
import pickle  # Import pickle to save the model
import os

# Load the dataset
dataset = pd.read_excel('Superstore.xlsx')

# Select the features
features = dataset[['Sales', 'Profit', 'Quantity', 'Discount']]

# Scale the features
scaler = StandardScaler()
scaled_features = scaler.fit_transform(features)

# Determine the optimal number of clusters using the Elbow Method
wcss = []  # Within-cluster sum of squares

for i in range(1, 11):
    kmeans = KMeans(n_clusters=i, init='k-means++', max_iter=300, n_init=10, random_state=42)
    kmeans.fit(scaled_features)
    wcss.append(kmeans.inertia_)

# Plot the Elbow graph (optional)
plt.figure(figsize=(10, 6))
plt.plot(range(1, 11), wcss, marker='o')
plt.title('Elbow Method for Optimal Number of Clusters')
plt.xlabel('Number of Clusters')
plt.ylabel('WCSS')

# Applying K-Means to the dataset with the optimal number of clusters (e.g., 5)
optimal_clusters = 5  
kmeans = KMeans(n_clusters=optimal_clusters, init='k-means++', max_iter=300, n_init=10, random_state=42)
clusters = kmeans.fit_predict(scaled_features)

# Add the cluster assignment back to the DataFrame
dataset['Cluster'] = clusters

# Create a folder to save the models
output_folder = 'models_pkl'
if not os.path.exists(output_folder):
    os.makedirs(output_folder)

# Save the trained model to a .pkl file
model_path = os.path.join(output_folder, 'kmeans_model.pkl')
with open(model_path, 'wb') as model_file:
    pickle.dump(kmeans, model_file)

# Save the scaler to a .pkl file
scaler_path = os.path.join(output_folder, 'scaler_kmeans.pkl')
with open(scaler_path, 'wb') as scaler_file:
    pickle.dump(scaler, scaler_file)

# Visualizing the clusters using Sales and Profit as an example
colors = ['purple', 'orange', 'green', 'blue', 'brown']

plt.figure(figsize=(10, 6))

for cluster in range(5):
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