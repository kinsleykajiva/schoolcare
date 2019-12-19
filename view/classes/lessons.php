<style>
    .col-remake{
        padding-top: .75rem;
        padding-bottom: .75rem;
        border-radius: 0%;
        background-color:
                rgba(86,61,124,.15);
        border: 1px solid
        rgba(86,61,124,.2);
    }
    .pricingdiv{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        font-family: 'Source Sans Pro', Arial, sans-serif;
    }

    .pricingdiv ul.theplan{
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        border-top-left-radius: 50px;
        border-bottom-right-radius: 50px;
        color: white;
        background: #7c3ac9;
        position: relative;
        width: 250px; /* width of each table */
        margin-right: 10px; /* spacing between tables */
        margin-bottom: 1em;
        transition: all .5s;
    }

    .pricingdiv ul.theplan:hover{ /* when mouse hover over pricing table */
        transform: scale(1.05);
        transition: all .5s;
        z-index: 100;
        box-shadow: 0 0 10px gray;
    }

    .pricingdiv ul.theplan li{
        margin: 10px 20px;
        position: relative;
    }

    .pricingdiv ul.theplan li.title{
        font-size: 150%;
        font-weight: bold;
        text-align: center;
        margin-top: 20px;
        text-transform: uppercase;
        border-bottom: 5px solid white;
    }

    .pricingdiv ul.theplan:nth-of-type(2){
        background: #e53499;
    }

    .pricingdiv ul.theplan:nth-of-type(3){
        background: #2a2cc8;
    }

    .pricingdiv ul.theplan:last-of-type{ /* remove right margin in very last table */
        margin-right: 0;
    }

    /*very last LI within each pricing UL */
    .pricingdiv ul.theplan li:last-of-type{
        text-align: center;
        margin-top: auto; /*align last LI (price botton li) to the very bottom of UL */
    }

    .pricingdiv a.pricebutton{
        background: white;
        text-decoration: none;
        padding: 10px;
        display: inline-block;
        margin: 10px auto;
        border-radius: 5px;
        color: navy;
        text-transform: uppercase;
    }

    @media only screen and (max-width: 500px) {
        .pricingdiv ul.theplan{
            border-radius: 0;
            width: 100%;
            margin-right: 0;
        }

        .pricingdiv ul.theplan:hover{
            transform: none;
            box-shadow: none;
        }

        .pricingdiv a.pricebutton{
            display: block;
        }
    }
    .list_lessons{
        margin: 10px 15px; ;
        display: inline-block;
        /* You can also add some margins here to make it look prettier */
        zoom:1;
        *display:inline;
        /* this fix is needed for IE7- */
    }

</style>

<div class="page-header card">
    <div class="card-block">
       <!-- <button class="btn btn-mini btn-round btn-info"></button>-->


    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Lessons</h5>

        <div class="card-header-right">
            <ul class="list-unstyled card-option">
                <li><i class="fa fa-chevron-left"></i></li>
                <li><i class="fa fa-window-maximize full-card"></i></li>
                <li><i class="fa fa-minus minimize-card"></i></li>
                <li><i class="fa fa-refresh reload-card-remake"></i></li>
            </ul>
        </div>

    </div>
    <div class="card-block table-border-style">
            <div class="row">
                <div class=" col-remake col-md-1 text-center" style="visibility: hidden;">Sun</div>
                <div class=" col-remake col-md-2 text-center"> <div class="text-dribbble">20 Nov</div> Mon</div>
                <div class="col-remake col-md-2 text-center">Tue</div>
                <div class="col-remake col-md-2 text-center">Wen</div>
                <div class="col-remake col-md-2 text-center">Thu</div>
                <div class="col-remake col-md-2 text-center">Fri</div>
                <div class="col-remake col-md-1 text-center" style="visibility: hidden;">Sat</div>

            </div>
            <div class="row">
                <div class="col-remake col-md-1" style="visibility: hidden;">6</div>
                <div class="col-remake col-md-2" ><button onclick="onAddLessonOn('mon')" class="btn btn-primary btn-outline-primary btn-round btn-mini"><i class="icofont icofont-plus-circle"></i>Add Lesson</button></div>
                <div class="col-remake col-md-2" ><button onclick="onAddLessonOn('tue')" class="btn btn-primary btn-outline-primary btn-round btn-mini"><i class="icofont icofont-plus-circle"></i>Add Lesson</button></div>
                <div class="col-remake col-md-2" ><button onclick="onAddLessonOn('wed')" class="btn btn-primary btn-outline-primary btn-round btn-mini"><i class="icofont icofont-plus-circle"></i>Add Lesson</button></div>
                <div class="col-remake col-md-2" ><button onclick="onAddLessonOn('thu')" class="btn btn-primary btn-outline-primary btn-round btn-mini"><i class="icofont icofont-plus-circle"></i>Add Lesson</button></div>
                <div class="col-remake col-md-2" ><button onclick="onAddLessonOn('fri')" class="btn btn-primary btn-outline-primary btn-round btn-mini"><i class="icofont icofont-plus-circle"></i>Add Lesson</button></div>

                <div class="col-remake col-md-1" style="visibility: hidden;">7</div>
            </div>
    </div>
</div>
<?php require 'lessons/select-lesson.php';?>
