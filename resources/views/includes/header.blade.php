 <!-- app-header -->
 <header class="app-header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="{{asset('/')}}" class="header-logo">
                        <img src="{{ asset('assets/images/brand-logos/desktop-logo.png') }}" alt="logo" class="desktop-logo">
                        <img src="{{ asset('assets/images/brand-logos/toggle-logo.png') }}" alt="logo" class="toggle-logo">
                        <img src="{{ asset('assets/images/brand-logos/desktop-white.png') }}" alt="logo" class="desktop-white">
                        <img src="{{ asset('assets/images/brand-logos/toggle-white.png') }}" alt="logo" class="toggle-white">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);">
                    <i class="header-icon fe fe-align-left"></i>
                </a>
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right">

            <div class="header-element Search-element d-block d-lg-none">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"  class="header-link-icon"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu dropdown-menu-end Search-element-dropdown" data-popper-placement="none">
                    <li>
                        <div class="input-group w-100 p-2"> 
                            <input type="text" class="form-control" placeholder="Search....">
                            <div class="btn btn-primary"> 
                                <i class="fa fa-search" aria-hidden="true"></i> 
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Start::header-element -->
            <div class="header-element headerProfile-dropdown">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <img src="{{ asset('assets/images/faces/6.jpg') }}" alt="img" width="37" height="37" class="rounded-circle">
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 header-profile-dropdown dropdown-menu-end main-profile-menu" aria-labelledby="mainHeaderProfile">
                    <li>
                        <div class="main-header-profile bg-primary menu-header-content text-fixed-white">
                            <div class="my-auto">
                                <h6 class="mb-0 lh-1 text-fixed-white">{{Auth::user()->name}}</h6><span class="fs-11 op-7 lh-1">{{Auth::user()->role_name}}</span>
                            </div>
                        </div>
                    </li>
                    <li><a class="dropdown-item d-flex" href="{{asset('user/profile')}}"><i class="bx bx-user-circle fs-18 me-2 op-7"></i>Thông tin cá nhân</a></li>
                  <!--   <li><a class="dropdown-item d-flex" href="editprofile.html"><i class="bx bx-cog fs-18 me-2 op-7"></i>Edit Profile </a></li>
                    <li><a class="dropdown-item d-flex border-block-end" href="mail.html"><i class="bx bxs-inbox fs-18 me-2 op-7"></i>Inbox</a></li>
                    <li><a class="dropdown-item d-flex" href="chat.html"><i class="bx bx-envelope fs-18 me-2 op-7"></i>Messages</a></li>
                    <li><a class="dropdown-item d-flex border-block-end" href="editprofile.html"><i class="bx bx-slider-alt fs-18 me-2 op-7"></i>Account Settings</a></li>
                -->
                <li><a class="dropdown-item d-flex" href="/logout"><i class="bx bx-log-out fs-18 me-2 op-7"></i>Đăng xuất</a></li>
                </ul>
            </div>  
            <!-- End::header-element -->

            <!-- Start::header-element -->
           <!--  <div class="header-element">
                <a href="javascript:void(0);" class="header-link switcher-icon" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas">
                    <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" width="24" height="24" viewBox="0 0 24 24"><path d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2z"></path><path d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.718 7.718 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.1 8.1 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733zm3.326-2.758A5.703 5.703 0 0 1 6 12c0-.462.058-.926.17-1.378a.999.999 0 0 0-.47-1.108l-1.123-.65.998-1.729 1.145.662a.997.997 0 0 0 1.188-.142 6.071 6.071 0 0 1 2.384-1.399A1 1 0 0 0 11 5.3V4h2v1.3a1 1 0 0 0 .708.956 6.083 6.083 0 0 1 2.384 1.399.999.999 0 0 0 1.188.142l1.144-.661 1 1.729-1.124.649a1 1 0 0 0-.47 1.108c.112.452.17.916.17 1.378 0 .461-.058.925-.171 1.378a1 1 0 0 0 .471 1.108l1.123.649-.998 1.729-1.145-.661a.996.996 0 0 0-1.188.142 6.071 6.071 0 0 1-2.384 1.399A1 1 0 0 0 13 18.7l.002 1.3H11v-1.3a1 1 0 0 0-.708-.956 6.083 6.083 0 0 1-2.384-1.399.992.992 0 0 0-1.188-.141l-1.144.662-1-1.729 1.124-.651a1 1 0 0 0 .471-1.108z"></path></svg>
                </a>
            </div> -->
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>
<!-- /app-header -->

<!-- Start::Off-canvas sidebar-->
<div class="offcanvas offcanvas-end" tabindex="-1" id="header-sidebar" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header rounded-0">
        <h5 class="fs-14 text-uppercase mb-0 fw-semibold" id="sidebarLabel">Notifications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body rounded-0 p-0">
        <ul class="nav nav-tabs tab-style-1 d-block" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#chat" aria-current="page" href="#chat" aria-selected="false" role="tab" tabindex="-1"><i class="fe fe-message-circle fs-15 me-2"></i>Chat</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#notifications" href="#notifications" aria-selected="false" role="tab" tabindex="-1"><i class="fe fe-bell fs-15 me-2"></i> Notifications</a>
            </li>
            <li class="nav-item mb-0" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#friends" href="#friends" aria-selected="true" role="tab"><i class="fe fe-users fs-15 me-2"></i>Friends</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane border-start-0 border-end-0 rounded-0 p-0" id="chat" role="tabpanel">
                <div class="list d-flex align-items-center border-bottom p-3">
                    <div class="">
                        <span class="avatar bg-primary rounded-circle avatar-md">CH</span>
                    </div>
                    <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                        <p class="mb-0 d-flex ">
                            <b>New Websites is Created</b>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                <small class="text-muted ms-auto">30 mins ago</small>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="list d-flex align-items-center border-bottom p-3">
                    <div class="">
                        <span class="avatar bg-danger rounded-circle avatar-md">N</span>
                    </div>
                    <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                        <p class="mb-0 d-flex ">
                            <b>Prepare For the Next Project</b>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                <small class="text-muted ms-auto">2 hours ago</small>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="list d-flex align-items-center border-bottom p-3">
                    <div class="">
                        <span class="avatar bg-info rounded-circle avatar-md">S</span>
                    </div>
                    <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                        <p class="mb-0 d-flex ">
                            <b>Decide the live Discussion</b>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                <small class="text-muted ms-auto">3 hours ago</small>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="list d-flex align-items-center border-bottom p-3">
                    <div class="">
                        <span class="avatar bg-warning rounded-circle avatar-md">K</span>
                    </div>
                    <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                        <p class="mb-0 d-flex ">
                            <b>Meeting at 3:00 pm</b>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                <small class="text-muted ms-auto">4 hours ago</small>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="list d-flex align-items-center border-bottom p-3">
                    <div class="">
                        <span class="avatar bg-success rounded-circle avatar-md">R</span>
                    </div>
                    <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                        <p class="mb-0 d-flex ">
                            <b>Prepare for Presentation</b>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                <small class="text-muted ms-auto">1 day ago</small>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="list d-flex align-items-center border-bottom p-3">
                    <div class="">
                        <span class="avatar bg-pink rounded-circle avatar-md">MS</span>
                    </div>
                    <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                        <p class="mb-0 d-flex ">
                            <b>Prepare for Presentation</b>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                <small class="text-muted ms-auto">1 day ago</small>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="list d-flex align-items-center border-bottom p-3">
                    <div class="">
                        <span class="avatar bg-purple rounded-circle avatar-md">L</span>
                    </div>
                    <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                        <p class="mb-0 d-flex ">
                            <b>Prepare for Presentation</b>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                <small class="text-muted ms-auto">45 minutes ago</small>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="list d-flex align-items-center p-3">
                    <div class="">
                        <span class="avatar bg-blue rounded-circle avatar-md">U</span>
                    </div>
                    <a class="wrapper w-100 ms-3" href="javascript:void(0);" >
                        <p class="mb-0 d-flex ">
                            <b>Prepare for Presentation</b>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa-regular fa-clock text-muted me-1 fs-11"></i>
                                <small class="text-muted ms-auto">2 days ago</small>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="tab-pane border-start-0 border-end-0 rounded-0 p-0" id="notifications" role="tabpanel">
                <div class="list-group list-group-flush ">
                    <div class="list-group-item d-flex  align-items-center">
                        <span class="avatar avatar-lg online avatar-rounded flex-shrink-0">
                            <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="img">
                        </span>
                        <div class="ms-3">
                            <strong>Madeleine</strong> Hey! there I' am available....
                            <div class="small text-muted">
                                3 hours ago
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="tab-pane border-start-0 border-end-0 rounded-0 p-0 active show" id="friends" role="tabpanel">
                <div class="list-group list-group-flush ">
                    <div class="list-group-item d-flex  align-items-center">
                        <span class="avatar avatar-md online avatar-rounded flex-shrink-0">
                            <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="img">
                        </span>
                        <div class="ms-2">
                            <div class="fw-semibold" data-bs-toggle="modal" data-bs-target="#chatmodel">Mozelle Belt</div>
                        </div>
                        <div class="ms-auto">
                            <a href="javascript:void(0);" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#chatmodel"><i class="fab fa-facebook-messenger"></i></a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>
<!-- End::Off-canvas sidebar-->

<!-- Message Modal -->
<div class="modal fade" id="chatmodel" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-right chatbox" role="document">
        <div class="modal-content chat border-0">
            <div class="card overflow-hidden mb-0 border-0 shadow-none">
                <!-- action-header -->
                <div class="action-header clearfix">
                    <div class="float-start hidden-xs d-flex">
                        <div class="avatar avatar-lg rounded-circle me-3">
                            <img src="{{ asset('assets/images/faces/6.jpg') }}" class="rounded-circle user_img" alt="img">
                        </div>
                        <div class="align-items-center mt-2">
                            <h5 class="text-fixed-white mb-0">Daneil Scott</h5>
                            <span class="dot-label bg-success"></span><span class="me-3 text-fixed-white">online</span>
                        </div>
                    </div>
                    <ul class="ah-actions actions align-items-center float-end">
                        <li class="call-icon">
                            <a href="" class="d-done d-md-block phone-button" data-bs-toggle="modal" data-bs-target="#audiomodal">
                                <i class="fe fe-phone"></i>
                            </a>
                        </li>
                        <li class="video-icon">
                            <a href="" class="d-done d-md-block phone-button" data-bs-toggle="modal" data-bs-target="#videomodal">
                                <i class="fe fe-video"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="dropdown-item"><i class="fa fa-user-circle"></i> View profile</li>
                                <li class="dropdown-item"><i class="fa fa-users"></i>Add friends</li>
                                <li class="dropdown-item"><i class="fa fa-plus"></i> Add to group</li>
                                <li class="dropdown-item"><i class="fa fa-ban"></i> Block</li>
                            </ul>
                        </li>
                        <li>
                            <a href=""  class="" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fe fe-x-circle text-fixed-white"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- action-header end -->

                <!-- msg_card_body -->
                <div class="card-body msg_card_body">
                    <div class="chat-box-single-line">
                        <abbr class="timestamp">February 1st, 2019</abbr>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="img_cont_msg">
                            <img src="{{ asset('assets/images/faces/6.jpg') }}" class="rounded-circle user_img_msg" alt="img">
                        </div>
                        <div class="msg_cotainer">
                            Hi, how are you Jenna Side?
                            <span class="msg_time">8:40 AM, Today</span>
                        </div>
                    </div>
                    
                </div>
                <!-- msg_card_body end -->
                <!-- card-footer -->
                <div class="card-footer border-top">
                    <div class="msb-reply d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Typing....">
                            <button type="button" class="btn btn-primary ">
                                <i class="far fa-paper-plane" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div><!-- card-footer end -->
            </div>
        </div>
    </div>
</div>
<!--End modal -->

<!--Video Modal -->
<div id="videomodal" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-fixed-dark border-0">
            <div class="modal-body mx-auto text-center p-5">
                <h5 class="text-fixed-white">Valex Video call</h5>
                <img src="{{ asset('assets/images/faces/6.jpg') }}" class="rounded-circle user-img-circle h-8 w-8 mt-4 mb-3" alt="img">
                <h4 class="mb-1 fw-semibold text-fixed-white">Daneil Scott</h4>
                <h6 class="loading text-fixed-white">Calling...</h6>
                <div class="mt-5">
                    <div class="row">
                        <div class="col-4">
                            <a class="icon icon-shape rounded-circle mb-0" href="javascript:void(0);">
                                <i class="fas fa-video-slash"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="icon icon-shape rounded-circle text-fixed-white mb-0" href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-phone bg-danger text-fixed-white"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="icon icon-shape rounded-circle mb-0" href="javascript:void(0);">
                                <i class="fas fa-microphone-slash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- modal-body -->
        </div>
    </div><!-- modal-dialog -->
</div>
<!--End modal -->

<!-- Audio Modal -->
<div id="audiomodal" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-body mx-auto text-center p-5">
                <h6>Valex Voice call</h6>
                <img src="{{ asset('assets/images/faces/6.jpg') }}" class="rounded-circle user-img-circle h-8 w-8 mt-4 mb-3" alt="img">
                <h5 class="mb-1 fw-medium">Daneil Scott</h5>
                <h6 class="loading">Calling...</h6>
                <div class="mt-5">
                    <div class="row">
                        <div class="col-4">
                            <a class="icon icon-shape rounded-circle mb-0" href="javascript:void(0);">
                                <i class="fas fa-volume-up bg-light text-dark"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="icon icon-shape rounded-circle text-fixed-white mb-0" href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-phone text-fixed-white bg-success"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a class="icon icon-shape  rounded-circle mb-0" href="javascript:void(0);">
                                <i class="fas fa-microphone-slash bg-light text-dark"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- modal-body -->
        </div>
    </div><!-- modal-dialog -->
</div>
<!--End modal -->