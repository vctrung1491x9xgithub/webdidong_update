<div id="myModal" class="modal-custom">
    <div class="modal-custom-content">
        <div class="modal-custom-header">
            <div>
                <h1 id="modal-custom-title"></h1>
            </div>
        </div>
        <div class="modal-custom-body">
            <p id="doc"></p>
        </div>
        <div class="modal-custom-footer">
            <span class="modal-custom-close">&times;</span>
        </div>
    </div>
</div>
<style>
    .modal-custom {
        width: 100%;
        height: 100%;
        background-color: #fff;
        position: fixed;
        top: 0;
        left: 0;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.8);
        display: none;
        align-items: center;
        z-index: 9999;
    }

    .modal-custom-content {
        position: relative;
        background: #fefefe;
        margin: 100px auto;
        padding: 20px;
        border-radius: 5px;
        width: 550px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.5s;
        animation-name: animatetop;
        animation-duration: 0.5s;
    }

    .modal-custom-header h1 {
        color: red;
        padding: 0 0 20px 0;
        font-size: 30px;
        border-bottom: 3px solid #EEEEEE;
    }

    .modal-custom-content .modal-custom-body {
        margin: 50px 0;
        font-size: 30px;
    }

    .modal-custom-content .modal-custom-body img {
        width: 100px;
        margin: 20px 0 0 0;
    }

    .modal-custom-close {
        color: red;
        font-size: 50px;
        border: 2px solid red;
        border-radius: 10px;
        padding: 0 20px 7px;
    }

    .modal-custom-close {
        color: #fff !important;
        background: tomato;
        transition: 0.5s all;
        cursor: pointer;
    }

    @-webkit-keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    .mystyle {
        display: flex;
    }
</style>