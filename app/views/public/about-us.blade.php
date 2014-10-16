@extends('layouts.public')

@section('content')
<div class="wrapper"> <!-- wrapper -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <br />
                <h4>Frequently Asked Questions</h4>
                <hr>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    Are your cleaners bonded, insured, and background checked?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                We are bonded and insured, and background checks are run against each person in each team we work with. This is one of the major benefits associated with using our business over an individual who may claim to take these precautions but does not.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    What are your Move In and Move Out cleanings?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                Our Move In/Out cleaning is designed to prepare an apartment or house for a new tenant; there's typically more room to be vacuumed, more baseboards to be detail cleaned, more cabinet and drawer space to be cleaned, light fixtures, etc. You can select it on our booking form under 'extras'. Please keep in mind that cleaning inside the fridge and oven are separate from our regular and move out cleanings.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                    How long does each cleaning take?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                Typically it comes out to about 1 hour per bedroom for a team of 2. In the case of extremely messy homes, we recommend using the move in/out option.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                    Do I have to be there when the cleaners arrive?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse">
                            <div class="panel-body">
                                No, you can leave a key for us to get in and we'll handle it from there. Some of our clients leave their key under a mat, in the mailbox, at a front-desk, or somewhere else out of sight. If you book online just remember to tell us where the key will be in the instructions, otherwise just give us a call.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                    What forms of payment do you accept?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse">
                            <div class="panel-body">
                                We accept all major credit cards and debit cards. We do not accept cash or checks. (If you'd like to tip your cleaner you may use cash however.)
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                                    Are your services actually green and eco-friendly?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseSix" class="panel-collapse collapse">
                            <div class="panel-body">
                                We do have teams that use only green products. Just request that you'd like a full green team on the booking form or phone and we'll make sure they're sent to your home!
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
                                    Who's responsible for the supplies?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseSeven" class="panel-collapse collapse">
                            <div class="panel-body">
                                We bring all of the necessary supplies, including a vacuum and paper towels. If you have a preferred product to use (e.g. for wood floors) just let us know.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
                                    Do you clean on the weekends?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseEight" class="panel-collapse collapse">
                            <div class="panel-body">
                                We work 7 days a week and start our first jobs at 8 am and finish around 6pm. We do our best to stay on live chat and phone to 8pm for any questions or booking concerns.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseNine">
                                    Can you clean if I'm not home?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseNine" class="panel-collapse collapse">
                            <div class="panel-body">
                                Yes we can, just let us know on the booking form how to get in.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTen">
                                    Do I have to contact you each time for recurring service?
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTen" class="panel-collapse collapse">
                            <div class="panel-body">
                                After you set up recurring service, we’ll be there like clockwork on the date and time you choose.  We will send a reminder email the day before so you will be expecting us.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FAQ Categories -->
            <div class="col-sm-4">
                <br>
                <h4>About Us</h4>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <p>MaidSavvy is NOT your typical Charlotte home cleaning company.
                            MaidSavvy is bringing cleaning services into the 21st century by building a company we
                            would want to do business with. We provide online booking, amazing
                            customer service, and awesome cleaning. We want to WOW you with outstanding treatment
                            and support every time we clean your home!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 well">
                        <h3>Get A Free Estimate</h3>
                        <hr>
                        <form class="form-inline" role="form" action="check_zip.php" method="post">
                            <div class="col-sm-12">
                                <div class="form-group" style="width:100%;">
                                    <label class="sr-only" for="zipcode">Zip Code</label>
                                    <input type="text" class="form-control" id="zipcode" name='zip' placeholder="Zip Code" maxlength="5" style="font-size:26px; height:52px;">
                                </div>
                                <br>
                                <button class="btn btn-success btn-large" style="font-size:26px; width:100%; height:52px; margin-top:15px;" type="submit">Check!</button>
                                <hr>
                                <p>
                                    Get a free estimate, view our available cleaning times, and even <b>schedule yourself entirely online!</b>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- / wrapper -->



@stop