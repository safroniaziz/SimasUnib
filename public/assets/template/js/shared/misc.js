(function ($) {
  'use strict';
  $(function () {
    var body = $('body');
    var contentWrapper = $('.content-wrapper');
    var scroller = $('.container-scroller');
    var footer = $('.footer');
    var sidebar = $('#sidebar');

    //Add active class to nav-link based on url dynamically
    //Active class can be hard coded directly in html file also as required
    var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
    $('#sidebar .nav li a').each(function () {
      var $this = $(this);
      if (current === "") {
        //for root url
        if ($this.attr('href').indexOf("index.html") !== -1) {
          $(this).parents('.nav-item').last().addClass('active');
          if ($(this).parents('.sub-menu').length) {
            $(this).addClass('active');
          }
        }
      } else {
        //for other url
        if ($this.attr('href').indexOf(current) !== -1) {
          $(this).parents('.nav-item').last().addClass('active');
          if ($(this).parents('.sub-menu').length) {
            $(this).addClass('active');
          }
          if (current !== "index.html") {
            $(this).parents('.nav-item').last().find(".nav-link").attr("aria-expanded", "true");
            if ($(this).parents('.sub-menu').length) {
              $(this).closest('.collapse').addClass('show');
            }
          }
        }
      }
    })

    $(".email-wrapper .mail-list-container .mail-list").on("click", function () {
      $(".email-wrapper .mail-list-container").addClass("d-none");
      $(".email-wrapper .mail-view").addClass("d-block");
    });
    $(".email-wrapper .mail-back-button").on("click", function () {
      $(".email-wrapper .mail-list-container").removeClass("d-none");
      $(".email-wrapper .mail-view").removeClass("d-block");
    });
    $(".aside-toggler").on("click", function () {
      $(".mail-sidebar").toggleClass("menu-open");
    });
    //Close other submenu in sidebar on opening any

    sidebar.on('show.bs.collapse', '.collapse', function () {
      sidebar.find('.collapse.show').collapse('hide');
    });


    //Change sidebar and content-wrapper height
    applyStyles();

    function applyStyles() {
      //Applying perfect scrollbar
      if (!body.hasClass("rtl")) {
        if ($('.settings-panel .tab-content .tab-pane.scroll-wrapper').length) {
          const settingsPanelScroll = new PerfectScrollbar('.settings-panel .tab-content .tab-pane.scroll-wrapper');
        }
        if ($('.chats').length) {
          const chatsScroll = new PerfectScrollbar('.chats');
        }
        if ($('.scroll-container').length) {
          const ScrollContainer = new PerfectScrollbar('.scroll-container');
        }
        if (body.hasClass("sidebar-fixed")) {
          var fixedSidebarScroll = new PerfectScrollbar('#sidebar .nav');
        }
        if ($('.ps-enabled').length) {
          const psEnabled = new PerfectScrollbar('.ps-enabled');
        }
      }
    }

    $('[data-toggle="minimize"]').on("click", function () {
      if ((body.hasClass('sidebar-toggle-display')) || (body.hasClass('sidebar-absolute'))) {
        body.toggleClass('sidebar-hidden');
      } else {
        body.toggleClass('sidebar-icon-only');
      }
    });

    //checkbox and radios
    $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');
  });

  // $(".sidebar .sidebar-inner > .nav > .nav-item").on("click", function () {
  //   $(".sidebar .sidebar-inner > .nav > .nav-item .submenu").removeClass("open");
  //   $(this).find(".submenu").toggleClass("open");
  // });

  $(".sidebar .sidebar-inner > .nav > .nav-item").not(".brand-logo").attr('toggle-status', 'closed');
  $(".sidebar .sidebar-inner > .nav > .nav-item").on('click', function () {
    $(".sidebar .sidebar-inner > .nav > .nav-item").removeClass("active");
    $(this).addClass("active");
    $(".sidebar .sidebar-inner > .nav > .nav-item").find(".submenu").removeClass("open");
    $(".sidebar .sidebar-inner > .nav > .nav-item").not(this).attr('toggle-status', 'closed');
    var toggleStatus = $(this).attr('toggle-status');
    if (toggleStatus == 'closed') {
      $(this).find(".submenu").addClass("open");
      $(this).attr('toggle-status', 'open');
    } else {
      $(this).find(".submenu").removeClass("open");
      $(this).not(".brand-logo").attr('toggle-status', 'closed');
    }
  });




})(jQuery);