<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="model-comparison.css">
    <!-- Chart.js for charts and graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="dashboard">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Admin Dashboard</h3>
        </div>
        <ul class="nav-links">
            <li><a href="#" class="active">Dashboard</a></li>
            <li><a href="#modelcomparison">Model Comparison</a></li>
            <li><a href="#">Sales Predictions</a></li>
            <li><a href="#">Recommendations</a></li>

            <!-- Chevron dropdown for Reports -->
            <li class="menu-item">
                <span>Reports</span>
                <button class="chevron-btn" onclick="toggleDropdown(); rotateChevron()">&#9662;</button>
            </li>
            <div id="dropdown" class="dropdown-content">
                <ul>
                    <li id="report1"><a href="#">Sales by State</a></li>
                    <li id="report2"><a href="#">Profit Margin Trends Over Time (2014)</a></li>
                    <li id="report3"><a href="#">Profit Margin Trends Over Time (2015)</a></li>
                    <li id="report4"><a href="#">Profit Margin Trends Over Time (2016)</a></li>
                    <li id="report5"><a href="#">Profit Margin Trends Over Time (2017)</a></li>
                    <li id="report6"><a href="#">Discount vs. Sales Scatter Plot</a></li>
                    <li id="report7"><a href="#">Sales by Category and Sub Category</a></li>
                    <li id="report8"><a href="#">Heatmap for Geographic Sales</a></li>
                    <li id="report9"><a href="#">Sales Performance Over Time (Time Series)</a></li>
                    <li id="report10"><a href="#">Profit by Product Category</a></li>
                    <li id="report11"><a href="#">Sales and Profit Relationship</a></li>
                </ul>
            </div>

            <li><a href="#">Users</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="homepage.php">Home</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <h2>Dashboard Overview</h2>
        </div>

        <!-- Profit Margin 2019 -->
        <section id="tableau1" class="tableau-graph">
            <h2>Sales by State (US)</h2>
            <div class='tableauPlaceholder' id='viz1727980785901' style='position: relative'><noscript><a href='#'><img alt='Sales by State ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-Workbook&#47;SalesbyState&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='Smart-Cart-Workbook&#47;SalesbyState' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-Workbook&#47;SalesbyState&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1727980785901');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
        </section>

        <section id="tableau2" class="tableau-graph">
            <h2>Profit Margin Trends Over Time (2014)</h2>
            <div class='tableauPlaceholder' id='viz1728059322859' style='position: relative'><noscript><a href='#'><img alt='Profit Margin Trends Over Time (2014) ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-PMTOT2014&#47;ProfitMarginTrendsOverTime2014&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='Smart-Cart-PMTOT2014&#47;ProfitMarginTrendsOverTime2014' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-PMTOT2014&#47;ProfitMarginTrendsOverTime2014&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1728059322859');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
        </section>

        <section id="tableau3" class="tableau-graph">
            <h2>Profit Margin Trends Over Time (2015)</h2>
            <div class='tableauPlaceholder' id='viz1728059732544' style='position: relative'><noscript><a href='#'><img alt='Profit Margin Trends Over Time (2015) ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-PMTOT2015&#47;ProfitMarginTrendsOverTime2015&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='Smart-Cart-PMTOT2015&#47;ProfitMarginTrendsOverTime2015' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-PMTOT2015&#47;ProfitMarginTrendsOverTime2015&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1728059732544');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
        </section>

        <section id="tableau4" class="tableau-graph">
            <h2>Profit Margin Trends Over Time (2016)</h2>
            <div class='tableauPlaceholder' id='viz1728059872343' style='position: relative'><noscript><a href='#'><img alt='Profit Margin Trends Over Time (2016) ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-PMTOT2016&#47;ProfitMarginTrendsOverTime2016&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='Smart-Cart-PMTOT2016&#47;ProfitMarginTrendsOverTime2016' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-PMTOT2016&#47;ProfitMarginTrendsOverTime2016&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1728059872343');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
        </section>

        <section id="tableau5" class="tableau-graph">
            <h2>Profit Margin Trends Over Time (2017)</h2>
            <div class='tableauPlaceholder' id='viz1728060005298' style='position: relative'><noscript><a href='#'><img alt='Profit Margin Sales Over Time (2017) ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-PMTOT2017&#47;ProfitMarginSalesOverTime2017&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='Smart-Cart-PMTOT2017&#47;ProfitMarginSalesOverTime2017' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-PMTOT2017&#47;ProfitMarginSalesOverTime2017&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1728060005298');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
        </section>

        <section id="tableau6" class="tableau-graph">
            <h2>Discount vs. Sales Scatter Plot</h2>
            <div class='tableauPlaceholder' id='viz1728060112285' style='position: relative'><noscript><a href='#'><img alt='Discount vs. Sales Scatter Plot ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-Discountvs_SalesScatterPlot&#47;Discountvs_SalesScatterPlot&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='Smart-Cart-Discountvs_SalesScatterPlot&#47;Discountvs_SalesScatterPlot' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-Discountvs_SalesScatterPlot&#47;Discountvs_SalesScatterPlot&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1728060112285');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
        </section>

        <section id="tableau7" class="tableau-graph">
            <h2>Sales by Category and Sub Category</h2>
            <div class='tableauPlaceholder' id='viz1728060297565' style='position: relative'><noscript><a href='#'><img alt='Sales by Category and Sub Category ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-SalesbyCategoryandSubCategory&#47;SalesbyCategoryandSubCategory&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='Smart-Cart-SalesbyCategoryandSubCategory&#47;SalesbyCategoryandSubCategory' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-SalesbyCategoryandSubCategory&#47;SalesbyCategoryandSubCategory&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1728060297565');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
        </section>

        <section id="tableau8" class="tableau-graph">
            <h2>Heatmap for Geographic Sales</h2>
            <div class='tableauPlaceholder' id='viz1728060488532' style='position: relative'><noscript><a href='#'><img alt='Heatmap for Geographic Sales ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-HfGS&#47;HeatmapforGeographicSales&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='Smart-Cart-HfGS&#47;HeatmapforGeographicSales' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-HfGS&#47;HeatmapforGeographicSales&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1728060488532');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
        </section>

        <section id="tableau9" class="tableau-graph">
            <h2>Sales Performance Over Time (Time Series)</h2>
            <div class='tableauPlaceholder' id='viz1728060725685' style='position: relative'><noscript><a href='#'><img alt=' Sales Performance Over Time (Time Series) ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-SPOT&#47;SalesPerformanceOverTimeTimeSeries&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='Smart-Cart-SPOT&#47;SalesPerformanceOverTimeTimeSeries' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-SPOT&#47;SalesPerformanceOverTimeTimeSeries&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1728060725685');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
        </section>

        <section id="tableau10" class="tableau-graph">
            <h2>Profit by Product Category</h2>
            <div class='tableauPlaceholder' id='viz1728061069543' style='position: relative'><noscript><a href='#'><img alt='Profit by Product Category ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-PbPC&#47;ProfitbyProductCategory&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='Smart-Cart-PbPC&#47;ProfitbyProductCategory' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-PbPC&#47;ProfitbyProductCategory&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1728061069543');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
        </section>

        <section id="tableau11" class="tableau-graph">
            <h2>Sales and Profit Relationship</h2>
            <div class='tableauPlaceholder' id='viz1728061307867' style='position: relative'><noscript><a href='#'><img alt='Sales and Profit Relationship ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-SaPR&#47;SalesandProfitRelationship&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='Smart-Cart-SaPR&#47;SalesandProfitRelationship' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Sm&#47;Smart-Cart-SaPR&#47;SalesandProfitRelationship&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='language' value='en-US' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1728061307867');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
        </section>

        <!-- Overview Cards -->
        <div class="overview-cards">
            <div class="card">
                <h4>Total Sales</h4>
                <p id="total-sales">$45,000</p>
            </div>
            <div class="card">
                <h4>Predicted Sales</h4>
                <p id="predicted-sales">$50,000</p>
            </div>
            <div class="card">
                <h4>Conversion Rate</h4>
                <p id="conversion-rate">4.2%</p>
            </div>
            <div class="card">
                <h4>Recommendations Accuracy</h4>
                <p id="recommendation-accuracy">88%</p>
            </div>
        </div>

        <!-- Charts and Graphs -->
        <div class="charts">
            <!-- Sales Prediction Chart -->
            <div class="chart-container">
                <h4>Sales Prediction</h4>
                <canvas id="salesPredictionChart"></canvas>
            </div>
            
            <!-- Recommendation Performance -->
            <div class="chart-container">
                <h4>Recommendation Performance</h4>
                <canvas id="recommendationChart"></canvas>
            </div>
        </div>

        <!-- Recent Sales Table -->
        <div class="sales-table">
            <h4>Recent Sales</h4>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2024-09-25</td>
                        <td>Product A</td>
                        <td>$25</td>
                        <td>3</td>
                        <td>$75</td>
                    </tr>
                    <tr>
                        <td>2024-09-24</td>
                        <td>Product B</td>
                        <td>$45</td>
                        <td>2</td>
                        <td>$90</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="container-mc" style="display: none;">
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

    </div>
</div>

<script src="dashboard.js"></script>
<script src="model-comparison.js"></script>

</body>
</html>