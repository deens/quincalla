@extends('app')
@section('content')
<!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h1>Checkout</h1>
            </div>
        </div>

        <!-- Row -->
        <div class="row">

            <!-- Main Col -->
            <div class="main-col col-md-9 mgb-30-xs">

                <!-- Checkout Accordion -->
                <div class="panel-group checkout" id="accordion">

                    <!-- Panel -->
                    <div class="panel panel-default">
                        <!-- Heading -->
                        <div class="panel-heading heading-iconed">
                            <h4 class="panel-title case-c">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                                    <i class="icon-left">1</i> checkout method
                                </a>
                            </h4>
                        </div>
                        <!-- /Heading -->

                        <!-- Collapse -->
                        <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">

                            <!-- Panel Body -->
                            <div class="panel-body">

                                <!-- Row -->
                                <div class="row">

                                    <!-- Col -->
                                    <div class="col-md-6 mgb-30-xs">
                                        <h6>New Customer</h6>
                                        <p>Dont have an account? Pick one of the options below.</p>
                                        <div class="radio"><label><input value="" name="acnt-opt" type="radio" checked="">Register Account</label></div>
                                        <div class="radio"><label><input value="" name="acnt-opt" type="radio">Checkout as guest</label></div>
                                        <p>Register with us for a fast and easy checkout and easy access to your order history and status</p>
                                        <button class="btn btn-default btn-bigger">continue</button>
                                    </div>
                                    <!-- /Col -->

                                    <!-- Col -->
                                    <div class="col-md-6">

                                        <h6>Sign In</h6>

                                        <!-- Form -->
                                        <form>
                                            <!-- Form Group -->
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" placeholder="Enter email">
                                            </div>
                                            <!-- /Form Group -->

                                            <!-- Form Group -->
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" placeholder="password">
                                            </div>
                                            <!-- /Form Group -->

                                            <!-- Form Group -->
                                            <div class="form-group">
                                                <label class="checkbox-inline"><input type="checkbox" value="">Remember me </label>
                                            </div>
                                            <!-- /Form Group -->

                                            <button class="btn btn-default btn-bigger">sign in</button>

                                        </form>
                                        <!-- /Form -->

                                    </div>
                                    <!-- /Col -->

                                </div>
                                <!-- /Row -->

                            </div>
                            <!-- /Panel Body -->

                        </div>
                        <!-- /Collapse -->

                    </div>
                    <!-- /Panel -->

                    <!-- Panel -->
                    <div class="panel panel-default">
                        <!-- Heading -->
                        <div class="panel-heading heading-iconed">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                                    <i class="icon-left">2</i> Billing Information
                                </a>
                            </h4>
                        </div>
                        <!-- /Heading -->

                        <!-- Collapse -->
                        <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">

                            <!-- Panel Body -->
                            <div class="panel-body">
                                <!-- Form -->
                                <form>
                                    <!-- Row -->
                                    <div class="row">
                                        <!-- Col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <!-- /Col -->

                                        <!-- Col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Second Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <!-- /Col -->

                                        <!-- Col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select class="form-control">
                                                    <option>Select country</option>
                                                    <option>England</option>
                                                    <option>Germany</option>
                                                    <option>France</option>
                                                    <option>Spain</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /Col -->

                                        <!-- Col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City / Town</label>
                                                <select class="form-control">
                                                    <option>Select city</option>
                                                    <option>New York</option>
                                                    <option>Paris</option>
                                                    <option>Nairobi</option>
                                                    <option>Cairo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /Col -->

                                        <!-- Col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <!-- /Col -->

                                        <!-- Col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input type="text" class="form-control" placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <!-- /Col -->

                                    </div>
                                    <!-- /Row -->

                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label>Address Line 1</label>
                                        <input type="text" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <!-- /Form Group -->

                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label>Address Line 2</label>
                                        <input type="text" class="form-control" placeholder="Enter Name">
                                    </div>
                                    <!-- /Form Group -->

                                </form>
                                <!-- Form -->

                            </div>
                            <!-- /Panel Body -->

                        </div>
                        <!-- /Collapse -->

                    </div>
                    <!-- /Panel -->

                    <!-- Panel -->
                    <div class="panel panel-default">
                        <!-- Heading -->
                        <div class="panel-heading heading-iconed">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                                    <i class="icon-left">3</i> Shippping Information
                                </a>
                            </h4>
                        </div>
                        <!-- /Heading -->

                        <!-- Collapse -->
                        <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">

                            <!-- Panel Body -->
                            <div class="panel-body">
                                <p>Please select a shipping method.</p>
                                <div class="radio"><label><input value="" name="acnt-opt" type="radio" checked="">Cash on delivery</label></div>
                                <div class="radio"><label><input value="" name="acnt-opt" type="radio">Send by courier</label></div>
                            </div>
                            <!-- /Panel Body -->

                        </div>
                        <!-- /Collapse -->

                    </div>
                    <!-- /Panel -->

                    <!-- Panel -->
                    <div class="panel panel-default">
                        <!-- Heading -->
                        <div class="panel-heading heading-iconed">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed" aria-expanded="false">
                                    <i class="icon-left">4</i> Payment Information
                                </a>
                            </h4>
                        </div>
                        <!-- /Heading -->

                        <!-- Collapse -->
                        <div id="collapseFour" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">

                            <!-- Panel Body -->
                            <div class="panel-body">

                                <p>Please select a payment method.</p>
                                <div class="radio"><label><input value="" name="acnt-opt" type="radio">Cash on delivery</label></div>
                                <div class="radio"><label><input value="" name="acnt-opt" type="radio">Paypal</label></div>
                                <div class="radio"><label><input value="" name="acnt-opt" type="radio" checked="">Credit Card</label></div>

                                <hr>

                                <!-- Row -->
                                <div class="row">

                                    <!-- Col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name on card</label>
                                            <input type="text" class="form-control" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <!-- /Col -->

                                    <!-- Col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Credit card number</label>
                                            <input type="text" class="form-control" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <!-- /Col -->

                                    <!-- Col -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Card Type</label>
                                            <select class="form-control">
                                                <option>Select country</option>
                                                <option>England</option>
                                                <option>Germany</option>
                                                <option>France</option>
                                                <option>Spain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /Col -->

                                    <!-- Col -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Expiration date</label>
                                            <select class="form-control">
                                                <option>Select city</option>
                                                <option>New York</option>
                                                <option>Paris</option>
                                                <option>Nairobi</option>
                                                <option>Cairo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /Col -->

                                    <!-- Col -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>CCV Code</label>
                                            <input type="text" class="form-control" placeholder="3 digits only">
                                        </div>
                                    </div>
                                    <!-- /Col -->

                                </div>
                                <!-- /Row -->

                                <hr>

                                <button class="btn btn-primary btn-sm btn-bigger">complete order</button>
                            </div>
                            <!-- /Panel Body -->
                        </div>
                        <!-- /Collapse -->

                    </div>
                    <!-- /Panel -->

                </div>
                <!-- /Accordion -->

            </div>
            <!-- /Main Col -->

            <!-- Side Col -->
            <div class="side-col col-md-3">

                <!-- Side Widget -->
                <div class="order-summary">
                    <table>
                        <tbody>
                        <tr>
                            <td>(6) Items</td>
                            <td class="price">$550.00</td>
                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td class="price"><span class="success">$50.00</span></td>
                        </tr>
                        <tr>
                            <td>Taxation</td>
                            <td class="price">15.00</td>
                        </tr>
                        <tr class="total">
                            <td> Total </td>
                            <td class="price">$615.00</td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-default btn-block btn-bigger">edit cart</button>
                    <button class="btn btn-primary btn-block btn-bigger">complete order</button>
                </div>
                <!-- /Side Widget -->


            </div>
            <!-- /Side Col -->

        </div>
        <!-- /Row -->

    </div>
@stop