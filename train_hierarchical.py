import pandas as pd
from sklearn.preprocessing import StandardScaler
from sklearn.cluster import AgglomerativeClustering
import matplotlib.pyplot as plt
import pickle
import scipy.cluster.hierarchy as sch
import os

# Load the dataset
dataset = pd.read_excel('Superstore.xlsx')

# Select the features
features = dataset[['Sales', 'Profit', 'Quantity', 'Discount']]

# Scale the features
scaler = StandardScaler()
scaled_features = scaler.fit_transform(features)

# Determine the optimal number of clusters using the Dendrogram
plt.figure(figsize=(10, 6))
dendrogram = sch.dendrogram(sch.linkage(scaled_features, method='ward'))
plt.title('Dendrogram for Optimal Number of Clusters')
plt.xlabel('Data Points')
plt.ylabel('Euclidean Distance')

# Apply Hierarchical Clustering to the dataset with the optimal number of clusters (e.g., 5)
optimal_clusters = 5
hierarchical = AgglomerativeClustering(n_clusters=optimal_clusters, metric='euclidean', linkage='ward')
clusters = hierarchical.fit_predict(scaled_features)

# Add the cluster assignment back to the DataFrame
dataset['Cluster'] = clusters

# Create a folder to save the models
output_folder = 'models_pkl'
if not os.path.exists(output_folder):
    os.makedirs(output_folder)

# Save the trained model to a .pkl file
model_path = os.path.join(output_folder, 'hierarchical_model.pkl')
with open(model_path, 'wb') as model_file:
    pickle.dump(hierarchical, model_file)

# Save the scaler to a .pkl file
scaler_path = os.path.join(output_folder, 'scaler_hierarchical.pkl')
with open(scaler_path, 'wb') as scaler_file:
    pickle.dump(scaler, scaler_file)

# Visualizing the clusters using Sales and Profit as an example
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