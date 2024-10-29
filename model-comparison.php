<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Model Comparison</title>
    <link rel="stylesheet" href="model-comparison.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body id="body-mc">
    <div class="container-mc">
        <h1 id="h1-mc">Model Comparison - KMeans vs Hierarchical</h1>

        <div class="model-card">
            <h2 id="h2-mc">KMeans</h2>
            <table>
                <tr>
                    <th>Metric</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Execution Time</td>
                    <td id="kmeans-exec-time"></td>
                </tr>
                <tr>
                    <td>Number of Clusters</td>
                    <td id="kmeans-clusters"></td>
                </tr>
                <tr>
                    <td>Inertia</td>
                    <td id="kmeans-inertia"></td>
                </tr>
                <tr>
                    <td>Silhouette Score</td>
                    <td id="kmeans-silhouette"></td>
                </tr>
                <tr>
                    <td>Adjusted Rand Index</td>
                    <td id="kmeans-ari"></td>
                </tr>
                <tr>
                    <td>Homogeneity Score</td>
                    <td id="kmeans-homogeneity"></td>
                </tr>
                <tr>
                    <td>Completeness Score</td>
                    <td id="kmeans-completeness"></td>
                </tr>
                <tr>
                    <td>Davies-Bouldin Index</td>
                    <td id="kmeans-dbi"></td>
                </tr>
                <tr>
                    <td>Calinski-Harabasz Index</td>
                    <td id="kmeans-chi"></td>
                </tr>
            </table>
        </div>

        <div class="model-card">
            <h2 id="h2-mc">Hierarchical</h2>
            <table>
                <tr>
                    <th>Metric</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Execution Time</td>
                    <td id="hierarchical-exec-time"></td>
                </tr>
                <tr>
                    <td>Number of Clusters</td>
                    <td id="hierarchical-clusters"></td>
                </tr>
                <tr>
                    <td>Linkage Type</td>
                    <td id="hierarchical-linkage"></td>
                </tr>
                <tr>
                    <td>Silhouette Score</td>
                    <td id="hierarchical-silhouette"></td>
                </tr>
                <tr>
                    <td>Adjusted Rand Index</td>
                    <td id="hierarchical-ari"></td>
                </tr>
                <tr>
                    <td>Homogeneity Score</td>
                    <td id="hierarchical-homogeneity"></td>
                </tr>
                <tr>
                    <td>Completeness Score</td>
                    <td id="hierarchical-completeness"></td>
                </tr>
                <tr>
                    <td>Davies-Bouldin Index</td>
                    <td id="hierarchical-dbi"></td>
                </tr>
                <tr>
                    <td>Calinski-Harabasz Index</td>
                    <td id="hierarchical-chi"></td>
                </tr>
            </table>
        </div>

        <!-- Graphs Section -->
        <div class="charts-container-mc hidden">
            <h2 id="h2-mc">Graphical Comparison</h2>
            <div class="chart-mc">
                <canvas id="executionTimeChart"></canvas>
            </div>
            <div class="chart-mc">
                <canvas id="silhouetteScoreChart"></canvas>
            </div>
            <div class="chart-mc">
                <canvas id="comparisonMetricChart"></canvas>
            </div>
        </div>

        <button id="compareBtn" onclick="handleCompareModels()">Compare Models</button>
    </div>

    <script src="model-comparison.js"></script>
</body>
</html>