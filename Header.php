<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./CSS/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<script>
setTimeout(function() {
    window.location.reload(1);
}, 5000);
</script>

<body>
    <input type="checkbox" id="menu_bar" checked>
    <input type="checkbox" id="menu_btn" checked> 
    <div class="header-container">
        <label for="menu_bar" class="menu_bar"><i class="fa-solid fa-bars"></i></label>
        <nav class="nav-container">
            <ul>
                <div class="list1">
                    <li class="list_item">
                        <a href="#">
                            <i class="fa-solid fa-house" style="color: #fff;"></i>
                            Home
                        </a>
                    </li>
                    <li class="list_item">
                        <a href="#"><i class="fa-solid fa-address-card"></i>
                            About us
                        </a>
                    </li>
                    <li class="list_item">
                        <a href="#">
                            <i class="fa-solid fa-circle-info"></i>
                            Info
                        </a>
                    </li>
                    <li class="list_item">
                        <a href="#"><i class="fa-solid fa-newspaper"></i>
                            Nieuws
                        </a>
                    </li>
                </div>
                <label for="menu_btn" class="menu_btn" ><i class="fa-regular fa-circle-left"></i></label>
                <div class="list2">
                    <li class="list_item">
                        <a href="#">
                            <i class="fa-brands fa-telegram"></i>
                            Contact
                        </a>
                    </li>
                    <li class="list_item">
                        <a href="#"><i class="fa-solid fa-right-to-bracket"></i>
                            Login</a>
                    </li>
                </div>
            </ul>
        </nav>
       
    </div>
</body>

</html>