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
        width: 95%;
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
        margin-bottom: 30px;
    }
    
    .paperSubmitBox p{
        font-size: 16px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .paperSubmitBox a{
        display: inline-block;
        margin: 0px 0px 40px 0px;
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

    /********************** START. REVIEWS ***************************/

    .buttonlike {
        background-color: #D9D9D9;
        padding: 0px 5px;
        border-radius: 9px;
        box-shadow: 3px 3px 3px darkgray;
    }

    .buttonlike:hover {
        background-color: #3A0000;
        color: white;
    }

    .rfkotakA {
        width: 90%;
        margin: auto;
        margin-top: 30px;
    }

    .rfkotakB {
        border-radius: 16px;
        border: 2px solid #3A0000;
        background: #FAFAFA;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        padding: 20px;
    }

    .rftable {
        border-collapse:collapse;
        width: 70%;
        margin: auto;
        margin-top: 15px;
    }

    .rftable td, .rftable th {
        border: 1px solid black;
        text-align: center;
    }

    .rftable th {
        background-color: #6A1515;
        color: white;
    }

    select {
        width: 100%;
        padding: 0;
        text-align: center;
        border: none;
    }

    .radioreview {
        width: 70%;
        margin: auto;
        margin-top: 15px;
    }

    .radioreview label{
        color: #3A0000;
        font-size: 19px;

    }

    .reviewcommentarea {
        width: 90%;
        margin: auto;
        margin-top: 20px;
        background-color: #e6dada;
        border: 1px solid #000;
        padding: 7px;
        display: flex;
        flex-direction: row;
        align-items: flex-start;
    }

    .rcatitle {
    align-self: flex-start;
    }

    .reviewsubmitbtn {
        width: 121px;
        height: 40px;
        border-radius: 9px;
        background: #D9D9D9;
        box-shadow: 2px 4px 4px 0px rgba(0, 0, 0, 0.25);
        color: #872D4A;
        font-size: 22px;
        font-weight: bold;
        margin-top: 13px;
    }

    .flex {
        display: flex;
    }

    .justify-center {
        justify-content: center;
    }

    button.reviewsubmitbtn {
        background-color: #D9D9D9;
    }

    button.reviewsubmitbtn:hover {
        background: #3A0000;
        color: white;
    }

    /********************** END. REVIEWS MENU. **********************/
    /********************* START. REGISTER MENU. ********************/

    tr.bor-bot th {
        border-bottom: 2px solid #C7A0AE;
    }

    .registerconferencebox{
        width: 70%;
        margin: auto;
        margin-top: 40px;
        margin-bottom: 40px;
        padding: 50px 30px 30px 30px;
        border-radius: 16px;
        border: 2px solid #3A0000;
        color: #3A0000;
    }

    /* Custom labels: the container */
    .checkcontainer {
        display: block;
        position: relative;
        padding-left: 28px;
        margin-bottom: 5px;
        cursor: pointer;
        -webkit-user-select: none; /* Chrome, Opera, Safari */
        -moz-user-select: none; /* Firefox 2+ */
        -ms-user-select: none; /* IE 10+ */
        user-select: none; /* Standard syntax */
    }

    /* Hide the browser's default checkbox */
    .checkcontainer input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }
    
    /* Create a custom radio button */
    .radiobtn{
        position: absolute;
        top: 6;
        left: 0;
        height: 18px;
        width: 18px;
        background-color: #eee;
        border-radius: 50%;
        border: 1px solid #3a0000;
    }

    /* On mouse-over, add a grey background color */
    .checkcontainer:hover input ~ .radiobtn{
        background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .checkcontainer input:checked ~ .radiobtn{
        background-color: #3a0000;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .radiobtn:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .checkcontainer input:checked ~ .radiobtn:after {
        display: block;
    }

    /* Style the indicator (dot/circle) */
    .checkcontainer .radiobtn:after {
        top: 4px;
        left: 5px;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: white;
    }

    /********************* END. REGISTER MENU. ********************/
    /********************* START. PAYMENT MENU. ********************/

    .payment-container {
        width: 80%;
        margin: auto;
        margin-top: 40px;
        border-radius: 50px;
        border: 2px solid #3A0000;
        padding: 40px;
    }

    .payment-header {
        font-size: x-large;
        color:#3a0000;
        font-weight: bold;
    }

    .kol-left {
        width: 35%;
        text-align: right;
        font-weight: bold;
    }

    .paym-det-box a {
        text-decoration: underline;
        color: blue;
    }

    .paym-det-box button {
        padding: 5px 15px;
        color: #f1f1f1;
        background-color: black;
    }

    .paym-det-box button:hover {
        box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.3);
    }

    .paym-det-box button:disabled {
        background-color: #bfbfbf;
        box-shadow: none;
    }

    /********************* END. PAYMENT MENU. ********************/
    /********************* START. ADD COCHAIR MENU. ********************/

    .assgcochairbox {
        border: 2px solid #3a0000;
        border-radius: 18px;
        width: 80%;
        margin: auto;
        margin-top: 40px;
        margin-bottom: 20px;
    }

    .cochair-list-box {
        width: 90%;
        margin: auto;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .ca-head {
        color: #3a0000;
        font-size: 20px;
        text-decoration-line: underline;
    }

    .coch-table {
        font-size: 16px;
        text-align: center;
    }

    .coch-table-left {
        text-align: left;
        width: 35%;
    }

    .acceptco {
        width: 121px;
        height: 40px;
        border-radius: 9px;
        background: green;
        box-shadow: 2px 4px 4px 0px rgba(0, 0, 0, 0.25);
        color: white;
        font-size: 22px;
        font-weight: bold;
        margin-top: 13px;
    }

    button.acceptco {
        background-color: green;
    }

    button.acceptco:hover {
        background: darkgreen;
        color: white;
    }

    .declineco {
        width: 121px;
        height: 40px;
        border-radius: 9px;
        background: red;
        box-shadow: 2px 4px 4px 0px rgba(0, 0, 0, 0.25);
        color: white;
        font-size: 22px;
        font-weight: bold;
        margin-top: 13px;
    }

    button.declineco {
        background-color: red;
    }

    button.declineco:hover {
        background: darkred;
        color: white;
    }

    .cochair-assign {
        border-radius: 16px;
        border: 2px solid #3A0000;
        width: 70%;
        margin: auto;
        margin-top: 20px;
        margin-bottom: 20px;
        align-items: center;
        text-align: center;
        padding: 22px 0px;
    }

    .cochair-assign-header {
        color: #872D4A;
        font-size: 22px;
        font-weight: bold;
    }

    .cochair-assign-email {
        padding: 25px 0px;
    }

    /********************* END. PAYMENT MENU. ********************/
    /********************* START. ADD COCHAIR MENU. ********************/


</style>