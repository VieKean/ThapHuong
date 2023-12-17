<!-- cay.php -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Thêm styles cho popup */
        .popup {
            opacity: 0;
            visibility: hidden;
            width: 300px;
            height: 374px;
            transition: opacity .5s ease, visibility .5s ease;
            transition: transform 0.5s ease, opacity 0.5s ease;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 15px 30px;
            background: rgb(249, 215, 212);
            background: linear-gradient(180deg, rgba(249, 215, 212, 1) 7%, rgba(245, 199, 199, 1) 38%, rgba(255, 113, 147, 1) 92%);
            color: #cc313d;
            font-size: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

        .popup.zoom-in {
            opacity: 1;
            visibility: visible;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .popup button {
            position: absolute;
            top: -1px;
            right: -1px;
            background-color: #1F2020;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: red;
        }

        /* Thêm styles cho overlay */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 998;
        }
    </style>
</head>

<body>
    <img id="anhCay" src="cay.png">

    <?php
    include "connect.php";
    $sql = "SELECT * FROM wishes ORDER BY id DESC LIMIT 32";
    $result = mysqli_query($conn, $sql);

    // In sản phẩm
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="c">';
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            $img = $row["image_path"];
            $text = $row["wish_text"];
            echo '<a class="anhLan" href="#" onclick="showPopup(\'' . $text . '\', \'' . $id . '\')"><li>';
            echo '<img src="' . $row['image_path'] . '">';
            echo '</li></a>';
        }

        echo '</div>';
    }

    if (isset($_GET['id'])) {
        $selectedId = $_GET['id'];

        $sql = "SELECT wish_text FROM wishes WHERE id = '$selectedId'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $wish_text = $row["wish_text"];
            echo '<script>showPopup("' . $wish_text . '", "' . $selectedId . '");</script>';
        }
    }
    ?>

    <!-- Popup container -->
    <div class="popup" id="popup">
        <p id="popupContent"></p>
        <button onclick="hidePopup()">Close</button>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>
    <a href="index.html">Về trang chủ</a>

    <script>
        var popup = document.getElementById('popup');
        var overlay = document.getElementById('overlay');

        function showPopup(content, id) {
            document.getElementById('popupContent').innerHTML = content;
            popup.classList.add('zoom-in'); // Add zoom-in class
            popup.style.opacity = 1;
            popup.style.visibility = 'visible';
            overlay.style.display = 'block';
            window.location.hash = id; // Add hash to URL to maintain state
        }

        function hidePopup() {
            popup.classList.remove('zoom-in'); // Remove zoom-in class
            popup.style.opacity = 0;
            popup.style.visibility = 'hidden';
            overlay.style.display = 'none';
            window.location.hash = '';
        }
    </script>

</body>

</html>


<style>
    #anhCay {
        height: 100vh;
        display: block;
        margin: 0 auto;
        position: relative;
    }

    .c {
        position: absolute;
        display: grid;
        row-gap: 50px;
        grid-template-columns: auto auto auto auto auto auto auto auto;
        top: 110px;
        left: 470px;
    }

    .c img {
        width: 50px;
        margin-left: 20px;
        display: block;
        transition: transform 0.3s;
        /* thêm transition để có hiệu ứng mượt mà */
    }

    .c img:hover {
        transform: scale(1.3);
        /* tăng kích thước lên 1.3 khi hover */
    }


    .c li {
        list-style: none;
    }
</style>