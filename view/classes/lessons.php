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
<div class="page-header card">
    <ul class="nav nav-tabs md-tabs " role="tablist">
        <li class="nav-item ">
            <a class="nav-link active " data-toggle="tab" href="#timetableView" role="tab" aria-expanded="true"> <i class="fa fa-table"></i> Lessons</a>
            <div class="slide"></div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#addlessons" role="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i>  Add Lesson</a>
            <div class="slide"></div>
        </li>
        <li class="nav-item" style="display: none;">
            <a class="nav-link" data-toggle="tab" href="#messages3" role="tab" aria-expanded="false">Messages</a>
            <div class="slide"></div>
        </li>
        <li class="nav-item" style="display: none;">
            <a class="nav-link" data-toggle="tab" href="#settings3" role="tab" aria-expanded="false">Settings</a>
            <div class="slide"></div>
        </li>
    </ul>
</div>

<div class="card">


    <div class="tab-content card-block">
        <div class="tab-pane active" id="timetableView" role="tabpanel" aria-expanded="true">
	        <?php include 'lessons/table-view-lessons.php';?>
        </div>
        <div class="tab-pane" id="addlessons" role="tabpanel" aria-expanded="false">
	        <?php  require 'lessons/create-lesson.php';?>
        </div>
        <div class="tab-pane" id="messages3" role="tabpanel" aria-expanded="false">
            <p class="m-0">3. This is Photoshop's version of Lorem IpThis is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean mas Cum sociis natoque penatibus et magnis dis.....</p>
        </div>
        <div class="tab-pane" id="settings3" role="tabpanel" aria-expanded="false">
            <p class="m-0">4.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p>
        </div>
    </div>
</div>
<?php require 'lessons/select-lesson.php'; ?>
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