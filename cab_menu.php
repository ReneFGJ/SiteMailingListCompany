    <link href="css/style_bp_bootstrap.css" rel="stylesheet">
    <link href="css/style_bp_bootstrap-responsive.css" rel="stylesheet">

    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

    <style>
        .navbar .popover {
            width: 500px;
            height: auto;
            -webkit-border-top-left-radius: 0px;
            -webkit-border-bottom-left-radius: 0px;
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
            overflow: hidden;
        }

        .navbar .popover-content {
            text-align: center;
        }

        .navbar .popover-content img {
            height: auto;
            max-width: 250px;
        }

        .navbar .dropdown-menu {
            -webkit-border-top-right-radius: 0px;
            -webkit-border-bottom-right-radius: 0px;
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;

            -webkit-box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar .dropdown-menu > li > a:hover {
            background-image: none;
            color: white;
            background-color: rgb(0, 129, 194);
            background-color: rgba(0, 129, 194, 0.5);
        }

        .navbar .dropdown-menu > li > a.maintainHover {
            color: white;
            background-color: #0081C2;
        }
    </style>

    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
  </head>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#"><?=msg('manutencao_module');?></a>
          <div class="nav-collapse collapse">
          	<div style="float: right; color: #FFFFFF;"><?=$user_name;?></div>
            <ul class="nav_top">
              <li class="active">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Main Menu</a>
                <ul class="dropdown-menu" role="menu">
                    <li data-submenu-id="submenu-cited">
                        <a href="cited.php"><?php echo msg('mm_cited');?></a>
                        <div id="submenu-cited" class="popoverx">
                            <h3 class="popover-title"><?php echo msg('mm_cited');?></h3>
                			<ul class="dropdown-menu" role="menu">
                				<li><A HREF="cited_artigos_sem_referencias.php?dd1=<?=(date("Y"));?>" class="submenu">Sem referencias <?=(date("Y"));?></A></li>
                				<li><A HREF="cited_artigos_sem_referencias.php?dd1=<?=(date("Y")-1);?>" class="submenu">Sem referencias <?=(date("Y")-1);?></A></li>
                				<li><A HREF="cited_artigos_sem_referencias.php?dd1=<?=(date("Y")-2);?>" class="submenu">Sem referencias <?=(date("Y")-2);?></A></li>
                				<li><A HREF="cited_artigos_sem_referencias.php?dd1=<?=(date("Y")-3);?>" class="submenu">Sem referencias <?=(date("Y")-3);?></A></li>
                				<li><A HREF="cited_process.php" class="submenu">Processar citações</A></li>
                			</ul>            
                        </div>
                    </li>
                    <li data-submenu-id="submenu-menu-01">
                        <a href="#">Journals</a>
                        <div id="submenu-menu-01" class="popover">
                            <h3 class="popover-title"><?php echo msg('mm_publication');?></h3>
                			<ul class="dropdown-menu2" role="menu2">
                				<li><A HREF="#" class="submenu">Journals</A></li>
                				<li><A HREF="#" class="submenu">Thesis</A></li>
                				<li><A HREF="#" class="submenu">Dissertation</A></li>
                			</ul>  
                        </div>
                    </li>
                    <li data-submenu-id="submenu-menu-02">
                        <a href="#">Journals</a>
                        <div id="submenu-menu-02" class="popover">
                            <h3 class="popover-title">Journals</h3>
                        </div>
                    </li>
                    <li data-submenu-id="submenu-menu-03">
                        <a href="#">Files</a>
                        <div id="submenu-menu-03" class="popover">
                            <h3 class="popover-title">Suport Files</h3>
                			<ul class="dropdown-menu2" role="menu2">
                				<li><A HREF="#" class="submenu">Convert VIEW to PDF</A></li>
                				<li><A HREF="#" class="submenu">Harvesting PDF</A></li>
                			</ul>  
                        </div>
                    </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="js/jquery.menu-aim.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script>

        var $menu = $(".dropdown-menu");

        // jQuery-menu-aim: <meaningful part of the example>
        // Hook up events to be fired on menu row activation.
        $menu.menuAim({
            activate: activateSubmenu,
            deactivate: deactivateSubmenu
        });
        // jQuery-menu-aim: </meaningful part of the example>

        // jQuery-menu-aim: the following JS is used to show and hide the submenu
        // contents. Again, this can be done in any number of ways. jQuery-menu-aim
        // doesn't care how you do this, it just fires the activate and deactivate
        // events at the right times so you know when to show and hide your submenus.
        function activateSubmenu(row) {
            var $row = $(row),
                submenuId = $row.data("submenuId"),
                $submenu = $("#" + submenuId),
                height = $menu.outerHeight(),
                width = $menu.outerWidth();

            // Show the submenu
            $submenu.css({
                display: "block",
                top: -1,
                left: width - 3,  // main should overlay submenu
                height: height - 4  // padding for main dropdown's arrow
            });

            // Keep the currently activated row's highlighted look
            $row.find("a").addClass("maintainHover");
        }

        function deactivateSubmenu(row) {
            var $row = $(row),
                submenuId = $row.data("submenuId"),
                $submenu = $("#" + submenuId);

            // Hide the submenu and remove the row's highlighted look
            $submenu.css("display", "none");
            $row.find("a").removeClass("maintainHover");
        }

        // Bootstrap's dropdown menus immediately close on document click.
        // Don't let this event close the menu if a submenu is being clicked.
        // This event propagation control doesn't belong in the menu-aim plugin
        // itself because the plugin is agnostic to bootstrap.
        $(".dropdown-menu li").click(function(e) {
            e.stopPropagation();
        });

        $(document).click(function() {
            // Simply hide the submenu on any click. Again, this is just a hacked
            // together menu/submenu structure to show the use of jQuery-menu-aim.
            $(".popover").css("display", "none");
            $("a.maintainHover").removeClass("maintainHover");
        });

    </script>


