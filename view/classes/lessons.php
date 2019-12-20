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
    section.pricing {
        background: #007bff;
        background: linear-gradient(to right, #0062E6, #33AEFF);
    }

    .pricing .card {
        border: none;
        border-radius: 1rem;
        transition: all 0.2s;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
    }

    .pricing hr {
        margin: .70rem 0;
    }

    .pricing .card-title {
       /* margin: 0.5rem 0;
        font-size: 0.9rem;
        letter-spacing: .1rem;
        font-weight: bold;*/
    }

    .pricing .card-price {
       /* font-size: 3rem;
        margin: 0;*/
    }

    .pricing .card-price .period {
        font-size: 0.8rem;
    }

    .pricing ul li {
        margin-bottom: 1rem;
    }

    .pricing .text-muted {
        opacity: 0.7;
    }

    .pricing .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: bold;
        padding: 1rem;
        opacity: 0.7;
        transition: all 0.2s;
    }

    /*#module {
        font-size: 1rem;
        line-height: 1.5;
    }


    #module #collapseExample.collapse:not(.show) {
        display: block;
        height: 3rem;
        overflow: hidden;
    }

    #module #collapseExample.collapsing {
        height: 3rem;
    }

    #module a.collapsed::after {
        content: '+ Show More';
    }

    #module a:not(.collapsed)::after {
        content: '- Show Less';
    }
*/
</style>

<div class="page-header card" style="display: none;">
    <div class="card-block">
       <!-- <button class="btn btn-mini btn-round btn-info"></button>-->


    </div>
</div>

<div class="card" style="" id="divViewLesson">
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
            <div class="row" id="days_dats">

                <div class=" col-remake col-md-1 text-center" style="display: none;">Sun</div>
                <div class=" col-remake col-md-2 text-center"> <div class="text-dribbble">20 Nov</div> Mon</div>
                <div class="col-remake col-md-2 text-center">Tue</div>
                <div class="col-remake col-md-2 text-center">Wen</div>
                <div class="col-remake col-md-2 text-center">Thu</div>
                <div class="col-remake col-md-2 text-center">Fri</div>
                <div class="col-remake col-md-1 text-center" style="display: none;">Sat</div>

            </div>
            <div class="row" id="divClickButtons">
                <div class="col-remake col-md-1" style="visibility: hidden;">6</div>
                <div class="col-remake col-md-2" ><button onclick="onAddLessonOn('Monday')" class="btn btn-primary btn-outline-primary btn-round btn-mini"><i class="icofont icofont-plus-circle"></i>Add Lesson</button></div>
                <div class="col-remake col-md-2" ><button onclick="onAddLessonOn('Tuesday')" class="btn btn-primary btn-outline-primary btn-round btn-mini"><i class="icofont icofont-plus-circle"></i>Add Lesson</button></div>
                <div class="col-remake col-md-2" ><button onclick="onAddLessonOn('Wednesday')" class="btn btn-primary btn-outline-primary btn-round btn-mini"><i class="icofont icofont-plus-circle"></i>Add Lesson</button></div>
                <div class="col-remake col-md-2" ><button onclick="onAddLessonOn('Thursday')" class="btn btn-primary btn-outline-primary btn-round btn-mini"><i class="icofont icofont-plus-circle"></i>Add Lesson</button></div>
                <div class="col-remake col-md-2" ><button onclick="onAddLessonOn('Friday')" class="btn btn-primary btn-outline-primary btn-round btn-mini"><i class="icofont icofont-plus-circle"></i>Add Lesson</button></div>

                <div class="col-remake col-md-1" style="display: none;">7</div>
            </div>
        <hr>
        <div class="" id="div_lessons"></div>
    </div>
</div>
<?php require 'lessons/select-lesson.php'; require 'lessons/create-lesson.php';?>

<div class="" id="milestoneDilaog" data-izimodal-title="MileStones Dialog">
    <div class="row">
        <div class="col-sm-12">
            <div class="">
                <div class="card-block">
                    <p id="mileStonedDetail"></p>
                </div>
            </div>
        </div>
    </div>
</div>
