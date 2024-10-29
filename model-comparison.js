// Simulating data fetch from the Flask app
function getModelMetrics() {
    return {
        kmeans: {
            executionTime: 2.3, // seconds
            clusters: 5,
            inertia: 120.45,
            silhouetteScore: 0.65,
            ari: 0.72,  // Adjusted Rand Index
            homogeneity: 0.75,
            completeness: 0.70,
            dbi: 0.89,  // Davies-Bouldin Index
            chi: 1200,  // Calinski-Harabasz Index
        },
        hierarchical: {
            executionTime: 3.7, // seconds
            clusters: 5,
            linkage: "ward",
            silhouetteScore: 0.61,
            ari: 0.70,  // Adjusted Rand Index
            homogeneity: 0.72,
            completeness: 0.68,
            dbi: 0.95,  // Davies-Bouldin Index
            chi: 1100,  // Calinski-Harabasz Index
        }
    };
}

// Function to compare models and display data
function compareModels() {
    const metrics = getModelMetrics();

    // Populate KMeans values
    document.getElementById("kmeans-exec-time").innerText = metrics.kmeans.executionTime + " seconds";
    document.getElementById("kmeans-clusters").innerText = metrics.kmeans.clusters;
    document.getElementById("kmeans-inertia").innerText = metrics.kmeans.inertia;
    document.getElementById("kmeans-silhouette").innerText = metrics.kmeans.silhouetteScore;
    document.getElementById("kmeans-ari").innerText = metrics.kmeans.ari;
    document.getElementById("kmeans-homogeneity").innerText = metrics.kmeans.homogeneity;
    document.getElementById("kmeans-completeness").innerText = metrics.kmeans.completeness;
    document.getElementById("kmeans-dbi").innerText = metrics.kmeans.dbi;
    document.getElementById("kmeans-chi").innerText = metrics.kmeans.chi;

    // Populate Hierarchical values
    document.getElementById("hierarchical-exec-time").innerText = metrics.hierarchical.executionTime + " seconds";
    document.getElementById("hierarchical-clusters").innerText = metrics.hierarchical.clusters;
    document.getElementById("hierarchical-linkage").innerText = metrics.hierarchical.linkage;
    document.getElementById("hierarchical-silhouette").innerText = metrics.hierarchical.silhouetteScore;
    document.getElementById("hierarchical-ari").innerText = metrics.hierarchical.ari;
    document.getElementById("hierarchical-homogeneity").innerText = metrics.hierarchical.homogeneity;
    document.getElementById("hierarchical-completeness").innerText = metrics.hierarchical.completeness;
    document.getElementById("hierarchical-dbi").innerText = metrics.hierarchical.dbi;
    document.getElementById("hierarchical-chi").innerText = metrics.hierarchical.chi;

    // Draw Charts
    drawExecutionTimeChart(metrics);
    drawSilhouetteScoreChart(metrics);
    drawComparisonMetricChart(metrics);
}

// Function to draw execution time comparison chart
function drawExecutionTimeChart(metrics) {
    const ctx = document.getElementById('executionTimeChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Execution Time (seconds)'],
            datasets: [
                {
                    label: 'KMeans',
                    data: [metrics.kmeans.executionTime],
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: '#007bff',
                    borderWidth: 2
                },
                {
                    label: 'Hierarchical',
                    data: [metrics.hierarchical.executionTime],
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderColor: '#28a745',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true, 
                    labels: {
                        color: '#000'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Function to draw silhouette score comparison chart
function drawSilhouetteScoreChart(metrics) {
    const ctx = document.getElementById('silhouetteScoreChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Silhouette Score'],
            datasets: [
                {
                    label: 'KMeans',
                    data: [metrics.kmeans.silhouetteScore],
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: '#007bff',
                    borderWidth: 2
                },
                {
                    label: 'Hierarchical',
                    data: [metrics.hierarchical.silhouetteScore],
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderColor: '#28a745',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,  // Show the legend so users can toggle datasets
                    labels: {
                        color: '#000'  // Legend text color
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Function to draw comparison of multiple metrics (ARI, Homogeneity, Completeness)
function drawComparisonMetricChart(metrics) {
    const ctx = document.getElementById('comparisonMetricChart').getContext('2d');
    new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Adjusted Rand Index', 'Homogeneity', 'Completeness', 'Davies-Bouldin Index', 'Calinski-Harabasz Index'],
            datasets: [
                {
                    label: 'KMeans',
                    data: [metrics.kmeans.ari, metrics.kmeans.homogeneity, metrics.kmeans.completeness, metrics.kmeans.dbi, metrics.kmeans.chi],
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                    borderWidth: 2
                },
                {
                    label: 'Hierarchical',
                    data: [metrics.hierarchical.ari, metrics.hierarchical.homogeneity, metrics.hierarchical.completeness, metrics.hierarchical.dbi, metrics.hierarchical.chi],
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderColor: '#28a745',
                    pointBackgroundColor: '#28a745',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                r: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Function to toggle charts visibility and compare models
function handleCompareModels() {
    const chartsContainer = document.querySelector('.charts-container-mc'); // Use querySelector for class

    // Show charts container if hidden
    if (chartsContainer) {
        // Check if the chartsContainer has a class to hide it
        if (chartsContainer.classList.contains('hidden')) {
            chartsContainer.classList.remove('hidden'); // Remove hidden class
            compareModels(); // Call the function to populate the data and draw charts
        }
    } else {
        console.error("Charts container not found!");
    }
}

// Wait for DOM content to load before adding event listeners
document.addEventListener("DOMContentLoaded", () => {
    const compareButton = document.getElementById('compareBtn');
    if (compareButton) {
        compareButton.addEventListener("click", handleCompareModels);
    } else {
        console.error("Compare button not found!");
    }
});