// Sales Prediction Chart
const salesPredictionCtx = document.getElementById('salesPredictionChart').getContext('2d');
const salesPredictionChart = new Chart(salesPredictionCtx, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Predicted Sales',
            data: [40000, 45000, 48000, 50000, 47000, 52000],
            borderColor: '#007bff',
            fill: false
        }, {
            label: 'Actual Sales',
            data: [42000, 46000, 49000, 51000, 46000, 53000],
            borderColor: '#28a745',
            fill: false
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Recommendation Performance Chart
const recommendationCtx = document.getElementById('recommendationChart').getContext('2d');
const recommendationChart = new Chart(recommendationCtx, {
    type: 'bar',
    data: {
        labels: ['Product A', 'Product B', 'Product C'],
        datasets: [{
            label: 'Recommendation Accuracy',
            data: [85, 90, 88],
            backgroundColor: ['#007bff', '#28a745', '#ffc107']
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

function toggleDropdown() {
    const dropdown = document.getElementById('dropdown');
    dropdown.classList.toggle('open');
}

function rotateChevron() {
    const chevronBtn = document.querySelector('.chevron-btn');
    
    // Toggle the rotation class
    chevronBtn.classList.toggle('rotate-90');
}

document.addEventListener('DOMContentLoaded', function() {
    // Query all report links and graphs
    const reports = document.querySelectorAll('.dropdown-content li');
    const tableauGraphs = document.querySelectorAll('.tableau-graph');
    const topbar = document.querySelector('.top-bar');
    const overviewCards = document.querySelector('.overview-cards');
    const charts = document.querySelector('.charts');
    const salesTable = document.querySelector('.sales-table');
    const dashboardLink = document.querySelector('.nav-links .active');

    // Hide all graphs and container-mc initially
    tableauGraphs.forEach(graph => graph.style.display = 'none');

    // Add event listeners to each report
    reports.forEach((report, index) => {
        report.addEventListener('click', function() {
            // Hide all graphs first
            tableauGraphs.forEach(graph => graph.style.display = 'none');

            // Show the graph corresponding to the clicked report
            const selectedGraph = document.querySelector(`#tableau${index + 1}`);
            if (selectedGraph) {
                selectedGraph.style.display = 'block';
            }

            // Hide other sections when a report is shown
            topbar.style.display = 'none';
            overviewCards.style.display = 'none';
            charts.style.display = 'none';
            salesTable.style.display = 'none';
        });
    });

    // Toggle visibility on clicking "Dashboard"
    dashboardLink.addEventListener('click', function() {
        // Hide all graphs
        tableauGraphs.forEach(graph => graph.style.display = 'none');

        // Show all other sections
        topbar.style.display = 'block';
        overviewCards.style.display = 'flex'; // Adjust based on your layout
        charts.style.display = 'flex'; // Adjust based on your layout
        salesTable.style.display = 'block'; // Adjust based on your layout
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Existing query selectors for reports and graphs
    const reports = document.querySelectorAll('.dropdown-content li');
    const tableauGraphs = document.querySelectorAll('.tableau-graph');
    const topbar = document.querySelector('.top-bar');
    const overviewCards = document.querySelector('.overview-cards');
    const charts = document.querySelector('.charts');
    const salesTable = document.querySelector('.sales-table');
    const dashboardLink = document.querySelector('.nav-links .active');
    
    // Select the "Model Comparison" link and container-mc
    const modelComparisonLink = document.querySelector('.nav-links a[href="#modelcomparison"]'); // Assuming this is the link for Model Comparison
    const containerMc = document.querySelector('.container-mc');
    
    // Hide container-mc initially
    containerMc.style.display = 'none';
    
    // Functionality to show and hide container-mc when Model Comparison is clicked
    modelComparisonLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior

        // Hide all graphs first
        tableauGraphs.forEach(graph => graph.style.display = 'none');

        // Always show container-mc without toggling it off
        containerMc.style.display = 'block';

        // Hide other sections when Model Comparison is shown
        topbar.style.display = 'none';
        overviewCards.style.display = 'none';
        charts.style.display = 'none';
        salesTable.style.display = 'none';
    });

    // Functionality to toggle graphs on clicking the reports
    reports.forEach((report, index) => {
        report.addEventListener('click', function() {
            // Hide container-mc and other graphs first
            tableauGraphs.forEach(graph => graph.style.display = 'none');
            containerMc.style.display = 'none';

            // Show the graph corresponding to the clicked report
            const selectedGraph = document.querySelector(`#tableau${index + 1}`);
            if (selectedGraph) {
                selectedGraph.style.display = 'block';
            }

            // Hide other sections when a report is shown
            topbar.style.display = 'none';
            overviewCards.style.display = 'none';
            charts.style.display = 'none';
            salesTable.style.display = 'none';
        });
    });

    // Toggle visibility on clicking "Dashboard"
    dashboardLink.addEventListener('click', function() {
        // Hide all graphs and container-mc
        tableauGraphs.forEach(graph => graph.style.display = 'none');
        containerMc.style.display = 'none';

        // Show all other sections
        topbar.style.display = 'block';
        overviewCards.style.display = 'flex'; // Adjust based on your layout
        charts.style.display = 'flex'; // Adjust based on your layout
        salesTable.style.display = 'block'; // Adjust based on your layout
    });
});