<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry Form</title>
</head>

<body>


    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close1" onclick="closePopup()" id="closeButton">&times;</span>
            <?php include "form.php"; ?>
        </div>
    </div>

    <script>
    function openPopup() {
        document.getElementById('myModal').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('myModal').style.display = 'none';
    }
    </script>




</body>

</html>