<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
        <label>Please enter a name: </label>
        <input type="text" id="name">
        </br>
        <label>Please enter an age: </label>
        <input type="number" id="age">

        <button type="button" id="button">Submit</button>
    </form>
    <p id="message"></p>

    <button type="button" id="getAllButton">Get All Persons</button>

    <div id="listUsers"></div>


    
    
    <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>

    <script>
        
        $(document).ready(function() {

            $('#button').on('click', function() {
                var name = $('#name').val();
                var age = $('#age').val();

                $.post('ajax_calls/store_new_person.php', {
                    name: name,
                    age: age
                }, function(data, status) {
                    $('#message').text(data)
                })
            })

            $('#getAllButton').on('click', function() {
                $.get('ajax_calls/get_all_persons.php', function(data, status) {
                        $('#listUsers').html(data);
                })
            })
        })

    </script>
</body>
</html>