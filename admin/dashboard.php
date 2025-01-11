<?php 
include 'connection.php'; 

// Total Pending Leaves
$queryPending = "SELECT COUNT(*) AS total_pending FROM leaves WHERE status = 0";
$resultPending = mysqli_query($con, $queryPending);
$totalPending = mysqli_fetch_assoc($resultPending)['total_pending'];

// Total Approved Leaves
$queryApproved = "SELECT COUNT(*) AS total_approved FROM leaves WHERE status = 1";
$resultApproved = mysqli_query($con, $queryApproved);
$totalApproved = mysqli_fetch_assoc($resultApproved)['total_approved'];

// Total Disapproved Leaves
$queryDisapproved = "SELECT COUNT(*) AS total_disapproved FROM leaves WHERE status = 2";
$resultDisapproved = mysqli_query($con, $queryDisapproved);
$totalDisapproved = mysqli_fetch_assoc($resultDisapproved)['total_disapproved'];

// Total Employees
$queryTotalEmployees = "SELECT COUNT(*) AS total_employees FROM users";
$resultTotalEmployees = mysqli_query($con, $queryTotalEmployees);
$totalEmployees = mysqli_fetch_assoc($resultTotalEmployees)['total_employees'];

// Leave Requests by Department
$query2 = "SELECT department, COUNT(*) AS count FROM leaves GROUP BY department";
$result2 = mysqli_query($con, $query2);
$departments = [];
$departmentCounts = [];
while ($row = mysqli_fetch_assoc($result2)) {
    $departments[] = $row['department'];
    $departmentCounts[] = $row['count'];
}

// Top Reasons for Leave
$query4 = "SELECT leavereason, COUNT(*) AS count FROM leaves GROUP BY leavereason ORDER BY count DESC LIMIT 10";
$result4 = mysqli_query($con, $query4);
$leaveReasons = [];
$reasonCounts = [];
while ($row = mysqli_fetch_assoc($result4)) {
    $leaveReasons[] = $row['leavereason'];
    $reasonCounts[] = $row['count'];
}

// Users with the Most Leaves
$query = "
    SELECT u.name, COUNT(l.id) AS leave_count
    FROM users u
    INNER JOIN leaves l ON u.email = l.email
    GROUP BY u.name
    ORDER BY leave_count DESC
    LIMIT 10";
$result = mysqli_query($con, $query);
$users = [];
$leaveCounts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row['name'];
    $leaveCounts[] = $row['leave_count'];
} // Fixed: Closing brace added here

// Leave Counts by Month
$queryMonths = "
    SELECT MONTHNAME(leavedate) AS month, COUNT(*) AS count
    FROM leaves
    GROUP BY MONTH(leavedate), MONTHNAME(leavedate)
    ORDER BY MONTH(leavedate)";
$resultMonths = mysqli_query($con, $queryMonths);
$months = [];
$monthCounts = [];
while ($row = mysqli_fetch_assoc($resultMonths)) {
    $months[] = $row['month'];
    $monthCounts[] = $row['count'];
}
?>



    <title>Leaves Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            max-width: 100%;
            height: 300px !important;
        }
        .chart-container {
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .card-container {
            margin-bottom: 20px;
        }
        .card h5 {
            font-size: 1.2rem;
        }
        h5 {
            font-weight: bold;
        }
    </style>


<!-- Dashboard Cards -->
<section id="dashboard">
    <div class="container mt-5">
        <div class="row card-container">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body text-center">
                        <h5>Total Approved Leaves</h5>
                        <h2><?php echo $totalApproved; ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body text-center">
                        <h5>Pending Leaves</h5>
                        <h2><?php echo $totalPending; ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body text-center">
                        <h5>Disapproved Leaves</h5>
                        <h2><?php echo $totalDisapproved; ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body text-center">
                        <h5>Total Employees</h5>
                        <h2><?php echo $totalEmployees; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Charts Section -->
<section id="post">
    <div class="container mt-5">
        <div class="row">
            <!-- Leave Requests by Department -->
            <div class="col-md-6">
                <div class="chart-container">
                    <h5 class="text-center">Leave Requests by Department</h5>
                    <canvas id="departmentLeaveChart"></canvas>
                </div>
            </div>
            <!-- Top Reasons for Leave -->
            <div class="col-md-6">
                <div class="chart-container">
                    <h5 class="text-center">Top Reasons for Leave</h5>
                    <canvas id="leaveReasonsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Top Users with Most Leaves -->
            <div class="col-md-6">
                <div class="chart-container">
                    <h5 class="text-center">Top Users with Most Leaves</h5>
                    <canvas id="mostLeavesChart"></canvas>
                </div>
            </div>
            <!-- Leaves by Month -->
            <div class="col-md-6">
                <div class="chart-container">
                    <h5 class="text-center">Leaves by Month</h5>
                    <canvas id="monthlyLeavesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Function to generate random colors
function generateRandomColors(count) {
    const colors = [];
    for (let i = 0; i < count; i++) {
        colors.push(`rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.8)`);
    }
    return colors;
}

// Leave Requests by Department
const departmentLeaveCtx = document.getElementById('departmentLeaveChart').getContext('2d');
new Chart(departmentLeaveCtx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($departments); ?>,
        datasets: [{
            label: 'Leave Requests',
            data: <?php echo json_encode($departmentCounts); ?>,
            backgroundColor: generateRandomColors(<?php echo count($departments); ?>)
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

// Top Reasons for Leave
const leaveReasonsCtx = document.getElementById('leaveReasonsChart').getContext('2d');
new Chart(leaveReasonsCtx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($leaveReasons); ?>,
        datasets: [{
            label: 'Number of Requests',
            data: <?php echo json_encode($reasonCounts); ?>,
            backgroundColor: generateRandomColors(<?php echo count($leaveReasons); ?>)
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        scales: {
            x: {
                beginAtZero: true
            }
        }
    }
});

// Top Users with Most Leaves
const mostLeavesCtx = document.getElementById('mostLeavesChart').getContext('2d');
new Chart(mostLeavesCtx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($users); ?>,
        datasets: [{
            label: 'Number of Leaves',
            data: <?php echo json_encode($leaveCounts); ?>,
            backgroundColor: generateRandomColors(<?php echo count($users); ?>)
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

// Leaves by Month
const monthlyLeavesCtx = document.getElementById('monthlyLeavesChart').getContext('2d');
new Chart(monthlyLeavesCtx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($months); ?>,
        datasets: [{
            label: 'Leave Requests by Month',
            data: <?php echo json_encode($monthCounts); ?>,
            backgroundColor: generateRandomColors(1)[0],
            borderColor: generateRandomColors(1)[0],
            borderWidth: 1
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

</script>

