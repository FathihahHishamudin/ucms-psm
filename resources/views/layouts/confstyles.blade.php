<style>
    @import url('https://fonts.googleapis.com/css2?family=Jaldi:wght@400;700&display=swap');
    
    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        margin: auto;
        width: 60%;
        position: relative;
    }

    /* Dropdown Button */
    .dropbtn {
    background-color: #9d6567;
    color: white;
    border: none;
    width: 100%;
    border-radius: 29.5px;
    text-transform: uppercase;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
    display: none;
    position: absolute;
    left: 50%;
    transform: translate(-50%);;
    background-color: #f1f1f1;
    min-width: 160px;
    width: 95%;
    border-radius: 29.5px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    }

    .column {
        float: left;
    }

    .column.side {
        width: 15%;
        font-size: 22px;
        margin-top: 1%;
    }

    .column.middle {
        width: 70%;
        font-size: 36px;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color: #AF8081; color: white;}

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {display: block;}

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {background-color: #6D3537;}

    .mb60 {
        margin-bottom: 60px;
    }

    .mt40 {
        margin-top: 40px;
    }

    .title {
        color: black;
        font-weight: bold;
        text-align: center;
        font-size: 26px;
        margin-top: 60px;
    }

    .abbr {
        color: black;
        font-weight: bold;
        text-align: center;
        font-size: 26px;
        margin-bottom: 60px;
    }

    .datevenue {
        color: black;
        font-weight: bold;
        text-align: center;
        font-size: 20px;
    }

    .desc {
        color: black;
        text-align: justify;
        font-size: 20px;
        width: 90%;
        margin: auto;
        margin-top: 40px;
    }

/********************** START. ON CONFERENCE DISPLAY. THE ANNOUNCEMENT BOX **********************/    
 
    .annou {
        margin: 0;
        background-color: #171618;
        height: 100vh;
        display: grid;
    }
    .cem {
        position: relative;
        padding: 30px 60px;
        color: black;
        text-decoration: none;
        letter-spacing: 4px;
        font-size: 20px;
        overflow: hidden;
        border: lightgray solid 1px;
    }

    .cem span:nth-child(1) {
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(to right, #171618, #D4181E);
        animation: animate1 2s linear infinite;
    }

    @keyframes animate1 {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
    }

    .cem span:nth-child(2) {
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        width: 3px;
        background: linear-gradient(to bottom, #171618, #D4181E);
        animation: animate2 2s linear infinite;
        animation-delay: 1s;
    }
    @keyframes animate2 {
        0% {
            transform: translateY(-100%);
        }
        100% {
            transform: translateY(100%);
        }
    }

    .cem span:nth-child(3) {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(to left, #171618, #D4181E);
        animation: animate3 2s linear infinite;
    }

    @keyframes animate3 {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(-100%);
        }
    }

    .cem span:nth-child(4) {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 3px;
        background: linear-gradient(to top, #171618, #D4181E);
        animation: animate4 2s linear infinite;
        animation-delay: 1s;
    }

    @keyframes animate4 {
        0% {
            transform: translateY(100%);
        }
        100% {
            transform: translateY(-100%);
        }
    }

/********************** END. ON CONFERENCE DISPLAY. THE ANNOUNCEMENT BOX **********************/       

/********************** START. COMMITTEE MENU. **********************/

    .pcmenu
    {
        width: 90%;
        margin: auto;
        padding-top: 40px;
    }

    .pcmenu.list
    {
        padding: 15px 0px;
        border-bottom: 1px solid lightgray;
    }

/********************** END. ON COMMITTEE MENU. **********************/       

/********************** START. MY PAPER MENU. **********************/

    .papersec-box {
        /* border: #171618 2px solid; */
        margin: 50px 0px 30px 20px;

    }

    .pdet-header-line {
        font-weight: bold;
        font-size: 22px;
        text-decoration: underline;
    }

    /* box to tell author to update their paper details - only visible if the title in null */
    .upddet {
        background-color: #dddddd;
        border-radius: 10px;
        padding: 20px 20px;
    }

    .paper-det-table{
        /* border: #171618 2px solid; */
        margin: 10px 0px 0px 20px;
    }

    /*Small header inside papersec-box*/
    .papersec-boxhead{
        font-size: 20px;
        margin-bottom: 20px;
    }

    /* table for paper submission*/
    .psub {
        border-collapse:collapse;
        width: 90%;
        margin:auto;
    }

    .psub td, .psub th {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    .psub th {
        background-color: #6A1515;
        color: white;
    }

    .psub td button{
        color: maroon;
        font-weight: bold;
    }

    .psub td button:hover {
        color: blue;
    }
    
    .psub td button:disabled {
        color: grey;
    }

    /*  part Action:Submit punya css */
    .paperSubmitBox{
        border: 2px solid black;
        border-radius: 16px;
        width: 70%;
        margin: auto;
        min-height: 210px;
        text-align: center;
    }

    .paperSubmitHeader{
        color: #872D4A;
        font-size: 22px;
        line-height: 37px;
        font-weight: bold;
        margin-top: 23px;
    }
    
    .paperSubmitBox p{
        font-size: 16px;
        margin-top: 40px;
        margin-bottom: 10px;
    }

    .paperSubmitBox a{
        display: inline-block;
        margin: 40px 0px 40px 0px;
        text-decoration: underline;
        color: blue;
    }

    .paperSubmitBox input{
        border: 2px solid #dfced3;
        padding: 10px;
        margin-bottom: 40px;
    }

    .paperSubmitBox button{
        padding: 5px 15px;
        color: #f1f1f1;
        background-color: black;
        margin-bottom: 25px;
    }

    .paperSubmitBox button:hover{
        box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.3);
    }

    .paperSubmitBox button:disabled {
        background-color: #bfbfbf;
        box-shadow: none;
    }



    /********************** END. MY PAPER MENU. **********************/

</style>