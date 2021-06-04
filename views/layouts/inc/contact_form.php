<section id="contact">
    <div class="box">
        <h2 class="section-title">Get in Touch with Me</h2>
        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Maecenas sed diam eget risus varius blandit sit amet non magna. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        <div class="divide20"></div>
        <div class="row text-center services-2">
            <div class="col-md-3 col-sm-6"> <i class="budicon-map"></i>
                <p>Moon Street Light Avenue <br />
                    14/05 Jupiter, JP 80630</p>
            </div>
            <div class="col-md-3 col-sm-6"> <i class="budicon-telephone"></i>
                <p>00 (123) 456 78 90 <br />
                    00 (987) 654 32 10 </p>
            </div>
            <div class="col-md-3 col-sm-6"> <i class="budicon-mobile"></i>
                <p>00 (123) 456 78 90 <br />
                    00 (987) 654 32 10 </p>
            </div>
            <div class="col-md-3 col-sm-6"> <i class="budicon-mail"></i>
                <p> <a class="nocolor" href="mailto:#">manager@email.com</a> <br />
                    <a class="nocolor" href="mailto:#">asistant@email.com</a>
                </p>
            </div>
        </div>
        <!-- /.services-2 -->
        <div class="divide30"></div>
        <div class="form-container">
            <div class="response alert alert-success"></div>
            <form class="forms" action="contact/form-handler.php" method="post">
                <fieldset>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-row text-input-row name-field">
                                <label>Name</label>
                                <input type="text" name="name" class="text-input defaultText required" />
                            </div>
                            <div class="form-row text-input-row email-field">
                                <label>Email</label>
                                <input type="text" name="email" class="text-input defaultText required email" />
                            </div>
                            <div class="form-row text-input-row subject-field">
                                <label>Subject</label>
                                <input type="text" name="subject" class="text-input defaultText" />
                            </div>
                        </div>
                        <div class="col-sm-6 lp5">
                            <div class="form-row text-area-row">
                                <label>Message</label>
                                <textarea name="message" class="text-area required"></textarea>
                            </div>
                            <div class="form-row hidden-row">
                                <input type="hidden" name="hidden" value="" />
                            </div>
                            <div class="nocomment">
                                <label for="nocomment">Leave This Field Empty</label>
                                <input id="nocomment" value="" name="nocomment" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="button-row pull-right">
                                <input type="submit" value="Send Message" name="submit" class="btn btn-submit bm0" />
                            </div>
                        </div>
                        <div class="col-sm-6 lp5">
                            <div class="button-row pull-left">
                                <input type="reset" value="Clear Message" name="reset" class="btn btn-submit bm0" />
                            </div>
                        </div>
                        <input type="hidden" name="v_error" id="v-error" value="Required" />
                        <input type="hidden" name="v_email" id="v-email" value="Enter a valid email" />
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- /.form-container -->
    </div>
    <!-- /.box -->
</section>
<!-- /#contact -->