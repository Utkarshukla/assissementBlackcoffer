<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Data Visualization Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <h1>Select Record Year:</h1>
    <select id="mySelects">
        <option value="2018">2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
        <option value="2027">2027</option>
        <option value="2028">2028</option>
        <option value="2029">2029</option>
        <option value="2030">2030</option>
        <option value="2031">2031</option>
        <option value="2032">2032</option>
        <option value="2033">2033</option>
        <option value="2034">2034</option>
        <option value="2035">2035</option>
        <option value="2036">2036</option>
        <option value="2037">2037</option>
        <option value="2038">2038</option>
        <option value="2039">2039</option>
        <option value="2040">2040</option>
        <option value="2041">2041</option>
        <option value="2042">2042</option>
        <option value="2043">2043</option>
        <option value="2044">2044</option>
        <option value="2045">2045</option>
        <option value="2048">2048</option>
        <option value="2049">2049</option>
        <option value="2050">2050</option>
        <option value="2053">2053</option>
        <option value="2056">2056</option>
      </select>
    <h4>Select Filter:</h4>
    <select id="mySelect">
        <option value="option1">Year</option>
        <option value="option2">topic</option>
        <option value="option3">sector</option>
        <option value="option4">region</option>
        <option value="option5">pest</option>
        <option value="option6">source</option>
        <option value="option7">country</option>
    </select>
    <button id="submitButton">Submit</button>





    <canvas id="myChart"></canvas>
    <script>
        $(document).ready(function() {

            $('#submitButton').click(function() {
                var value = $('#mySelect').val();
                // send to api
                var values = $('#mySelects').val();

                $.ajax({
                    url: "http://127.0.0.1:8000/api/index",
                    method: "POST",
                    data: {
                        values: values
                    },
                    dataType: "json",
                    success: function(data) {
                        var labels;
                        switch(value) {
                            case 'option1':
                             labels = data.map((entry) => entry.end_year);
                            break;

                            case 'option2':
                             labels = data.map((entry) => entry.topic);
                            break;

                            case 'option3':
                             labels = data.map((entry) => entry.sector);
                            break;

                            case 'option4':
                             labels = data.map((entry) => entry.region);
                            break;
                            
                            case 'option5':
                             labels = data.map((entry) => entry.pestle);
                            break;

                            case 'option6':
                             labels = data.map((entry) => entry.source);
                            break;

                            case 'option7':
                             labels = data.map((entry) => entry.country);
                            break;

                            default:
                             labels = data.map((entry) => entry.city);
                            break;
                        }
                       

alert(labels);
                        
                        const dataset1 = data.map((entry) => entry.intensity);
                        const dataset2 = data.map((entry) => entry.likelihood);
                        const dataset3 = data.map((entry) => entry.topic);
                        const dataset4 = data.map((entry) => entry.relevance);


                        var ctx = document.getElementById('myChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                        label: 'Intensity',
                                        data: dataset1,
                                        borderColor: 'red',
                                        fill: false
                                    },
                                    {
                                        label: 'Likelihood',
                                        data: dataset2,
                                        borderColor: 'blue',
                                        fill: false
                                    },
                                    {
                                        label: 'Topic',
                                        data: dataset3,
                                        borderColor: 'green',
                                        fill: false
                                    },
                                    {
                                        label: 'Relevance',
                                        data: dataset4,
                                        borderColor: 'orange',
                                        fill: false
                                    }
                                ]
                            },
                            options: {
                                responsive: true
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Handle error case
                    }
                });
            });
        });
    </script>

</body>

</html>
