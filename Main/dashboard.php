<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
else{
    $_SESSION['currentPage'] = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
}

require 'vendor/autoload.php';

function fetchLectureData() {
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->selectDatabase("CSIT321Development");
    $lecturesCollection = $database->selectCollection("lectures");

    return $lecturesCollection->find()->toArray();
}

function generateDashboard($lectureData) {
    // Generate dashboard content based on lecture data
    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <!-- Head content -->
    </head>
    
    <body class="bg-background p-0 m-0">
        <div id="sidebar"><?php include './src/components/sidebar.php'; ?></div>
    
        <div id="main-content" class="p-20 ml-304 flex flex-col h-screen justify-between">
            <!-- Dashboard content -->
        </div>
    </body>
    
    </html>
    <?php
    return ob_get_clean();
}

$lectureData = fetchLectureData();
echo generateDashboard($lectureData);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <link href="./src/css/index.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./tailwind.config.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <script src="./src/components/sidebar.js"></script>
    <script>
        $(document).ready(function () {
            let sidebar = generateSidebar();
            $('#sidebar').load('sidebar.php', function () {
                // Get references to elements
                const mainContent = $('#main-content');

                // Add event listener to the drawer for when it's shown or hidden
                $('#sidebar-large-button').click(function () {
                    mainContent.addClass('ml-sidebarSmall');
                    mainContent.removeClass('ml-sidebarLarge');
                });

                $('#sidebar-small-button').click(function () {
                    mainContent.addClass('ml-sidebarLarge');
                    mainContent.removeClass('ml-sidebarSmall');
                });

                $('#dropdown-button').click(function () {
                    $('#dropdown-arrow').toggleClass('bx-chevron-down');
                    $('#dropdown-arrow').toggleClass('bx-chevron-up');
                });
            });

            var graphData = {};

            $.getJSON("fetch_data.php", function (data) {
                // Process and display the data
                graphData = data;

                // Chart

                var donutSeries = [];
                var donutLabels = [];

                // Calculate average attendance for each subject
                graphData.forEach(entry => {
                    let totalAttendance = entry.attended_students.length;
                    let numDates = 1; // Assuming 1 date per lecture entry

                    let averageAttendance = totalAttendance / numDates;
                    donutSeries.push(parseFloat(averageAttendance.toFixed(2)));
                    donutLabels.push(entry.subject_id);
                });

                var chart = {
                    series: donutSeries,
                    chart: {
                        height: 500,
                        width: "100%",
                        type: "donut",
                    },
                    stroke: {
                        colors: ["transparent"],
                        lineCap: "d",
                    },
                    grid: {
                        padding: {
                            top: -2,
                        },
                    },
                    labels: donutLabels,
                    dataLabels: {
                        enabled: true,
                        formatter: function (val, opts) {
                            return opts.w.config.series[opts.seriesIndex] + "%";
                        },
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Quicksand",
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return value + "%";
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function (value) {
                                return value + "%";
                            },
                        },
                    },
                };

                // Render the chart
                var bChart = new ApexCharts(document.querySelector("#bar-chart"), chart);
                bChart.render();

                var totalSubjects = Object.keys(graphData).length;
                document.getElementById("totalSubjects").textContent = totalSubjects;

                // Calculate total students
                var totalStudents = 0;
                Object.keys(graphData).forEach(subject => {
                    totalStudents += graphData[subject].enrolled;
                });
                document.getElementById("totalStudents").textContent = totalStudents;

                // Calculate overall average attendance
                var totalAttendance = 0;
                var totalDates = 0;
                Object.keys(graphData).forEach(subject => {
                    graphData[subject].data.forEach(entry => {
                        totalAttendance += entry.attendance;
                        totalDates++;
                    });
                });
                var overallAverageAttendance = totalAttendance / totalDates;
                document.getElementById("averageAttendance").textContent = overallAverageAttendance
                    .toFixed(2) + "%";
            });

            $.getJSON("fetch_calendar_events.php", function (data) {
                const calendarEl = document.getElementById('calendar')
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    timeZone: 'UTC',
                    initialView: 'multiMonthYear',
                    events: data,
                    selectable: true,
                    eventColor: '#007bff',
                    buttonText: {
                        today: 'TODAY'
                    },
                })
                calendar.render()
            });
        });
    </script>
</head>

<body class="bg-background p-0 m-0">
    <div id="sidebar"></div>

    <div id="main-content" class="p-20 ml-304 flex flex-col h-screen justify-between">
        <div class="flex flex-row">
            <div class="flex flex-wrap gap-16 w-fit h-fit">
                <div class="bg-menu shadow-lg w-40 h-40 rounded-lg flex flex-col justify-center items-center">
                    <span class="text-2xl font-bold" id="totalSubjects"></span>
                    <span class="text-lg">Total Subjects</span>
                </div>
                <div class="bg-menu shadow-lg w-40 h-40 rounded-lg flex flex-col justify-center items-center">
                    <span class="text-2xl font-bold" id="totalStudents"></span>
                    <span class="text-lg">Total Students</span>
                </div>
                <div class="bg-menu shadow-lg w-40 h-40 rounded-lg flex flex-col justify-center items-center">
                    <span class="text-2xl font-bold" id="averageAttendance"></span>
                    <span class="text-lg">Avg Attendance</span>
                </div>
                <div class="bg-menu shadow-lg w-40 h-40 rounded-lg flex flex-col justify-center items-center">
                    <span class="text-2xl font-bold" id="nextClass">13/05/24</span>
                    <span class="text-lg">Next Lecture</span>
                </div>
            </div>
            <div class="bg-menu p-4 w-full h-fit rounded-lg">
                <div
                    class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                    <ul class="flex flex-wrap text-lg">
                        <li class="me-2">
                            <a href="#"
                                class="inline-block p-4 text-accent border-b-2 border-blue-600 rounded-t-lg active dark:text-accentDark dark:border-blue-500">Upcoming
                                Lessons</a>
                        </li>
                        <li class="me-2">
                            <a href="#"
                                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                aria-current="page">Previous Lessons</a>
                        </li>
                    </ul>
                </div>
                <table
                    class="mt-4 text-left [&_tr]:border-b-2 [&_tr]:border-accent [&_tr:not(:first-of-type)]:border-opacity-10 [&_tr_th]:py-2 [&_tr_td:not(first-of-type)]:pl-4 [&_tr_td:last-of-type]:pr-3 [&_tr_th:not(first-of-type)]:pl-4 [&_tr_td]:pb-2 [&_tr_td]:pt-2 [&_tr_:first-of-type]:pl-2 border-2 overflow-hidden w-full rounded-lg border-colapse border-spacing-0">
                    <tr>
                        <th>Subject Name</th>
                        <th>Subject Code</th>
                        <th>Type</th>
                        <th>Students Enrolled</th>
                        <th>Day</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Duration</th>
                    </tr>
                    <tr class="bg-accent/20">
                        <td>Fundamental Programming with Python</td>
                        <td>CSIT110</td>
                        <td>Lecture</td>
                        <td>48</td>
                        <td>Monday</td>
                        <td>13/05/2024</td>
                        <td>15:00</td>
                        <td class="relative">2 Hours<i
                                class="text-xl absolute right-3 top-1.5 my-auto bx bxs-book-alt"></i></td>
                    </tr>
                    <tr>
                        <td>Fundamental Programming with Python</td>
                        <td>CSIT110</td>
                        <td>Tutorial</td>
                        <td>23</td>
                        <td>Monday</td>
                        <td>13/05/2024</td>
                        <td>17:00</td>
                        <td>2 Hours</td>
                    </tr>
                    <tr>
                        <td>Programming Fundamentals</td>
                        <td>CSIT111</td>
                        <td>Lecture</td>
                        <td>53</td>
                        <td>Tuesday</td>
                        <td>14/05/2024</td>
                        <td>09:00</td>
                        <td>2 Hours</td>
                    </tr>
                    <tr>
                        <td>Programming Fundamentals</td>
                        <td>CSIT111</td>
                        <td>Tutorial</td>
                        <td>31</td>
                        <td>Tuesday</td>
                        <td>14/05/2024</td>
                        <td>13:00</td>
                        <td>2 Hours</td>
                    </tr>
                    <tr>
                        <td>Problem Solving</td>
                        <td>CSIT113</td>
                        <td>Lecture</td>
                        <td>46</td>
                        <td>Thursday</td>
                        <td>16/05/2024</td>
                        <td>10:00</td>
                        <td>2 Hours</td>
                    </tr>
                    <tr>
                        <td>Problem Solving</td>
                        <td>CSIT113</td>
                        <td>Thursday</td>
                        <td>21</td>
                        <td>Thursday</td>
                        <td>16/05/2024</td>
                        <td>12:00</td>
                        <td>2 Hours</td>
                    </tr>
                </table>
                <div class="mt-4 flex flex-col items-center">
                    <!-- Help text -->
                    <span class="text-sm text-textColour">
                        Showing <span class="font-semibold text-accent">1</span> to <span
                            class="font-semibold text-accent">6</span> of <span
                            class="font-semibold text-accent">24</span> Entries
                    </span>
                    <!-- Buttons -->
                    <div class="inline-flex mt-2 xs:mt-0">
                        <button
                            class="flex items-center justify-center px-3 h-8 text-sm font-medium text-textColour bg-menu border border-textAccent/40 rounded-s-lg hover:bg-accent">
                            Prev
                        </button>
                        <button
                            class="flex items-center justify-center px-3 h-8 text-sm font-medium text-textColour bg-menu border border-s border-textAccent/40 rounded-e-lg hover:bg-accent">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row gap-20 justify-between h-[600px] items-end">
            <div>
                <div id="barGraphContainer" class="w-[380px] h-fit p-6 bg-menu shadow-lg rounded-lg">
                    <div class="flex justify-between">
                        <div class="flex flex-col flex-grow">
                            <div class="flex items-center gap-2 text-textColour">
                                <span class="text-lg font-bold">Average Attendance</span>
                                <a href="#nothing">
                                    <i class="bx bx-info-circle"></i>
                                </a>
                            </div>
                        </div>
                        <a href="#nothing" class="text-lg">
                            <i class="text-textColour bx bx-dots-horizontal-rounded"></i>
                        </a>
                    </div>

                    <div id="bar-chart" class="py-4"></div>

                    <div class="flex items-center pt-4 border-t border-gray-500">
                        <a href="#nothing" class="text-textAccent flex flex-grow items-center gap-2">
                            <span>Last 90 days</span>
                            <i class="bx bx-chevron-down"></i>
                        </a>
                        <a href="#nothing" class="text-accentBold flex items-center gap-2">
                            <span>REPORT</span>
                            <i class="bx bx-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div>
                <div class="w-[1500px] h-[600px] flex flex-col p-4 break-words bg-menu shadow-lg rounded-lg">
                    <div data-toggle="calendar" id="calendar" class="overflow-hidden"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>