<?php
	$this->load->view("_partials/header.php");
	$total_count = $this->data['total_count'];
	$dates = $this->data['orders'];
?>
	<main id="main" class="row">
	    <?php
            $this->load->view("_partials/side_bar.php");
        ?>
	    <div class="large-12 medium-8 column">
	        <!-- Tabs content -->
	        <div id="main-content" class="tabs-content">
	            <!-- Dashboard -->
                <div id="dashboard" class="content active">
                    <!--
                        DASHBOARD VIEW ACTION
                    -->
                    <header class="store-action">
                        <button  class="button dropdown alert" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false">Orders</button>
                        <ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">
                            <li><a href="#">LIKES</a></li>
                            <li><a href="#">STAR</a></li>
                            <li><a href="#">CUSTOMERS</a></li>
                        </ul>  
                        
                        <!-- Actions -->
                        <ul class="no-bullet inline-list right">
                            <li><a class="lnk-underlined" href="dashboard-upcoming-craft-beer-releases.html" title="Upcoming Craft Beer Releases">Upcoming Craft Beer Releases</a></li>
                        </ul> <!-- end of: Actions -->
                    </header> <!-- END OF DASHBOARD VIEW ACTION -->
                    
                    <!-- Dashboard details -->
                    <article>
                        <!-- Stat filters -->
                        <ul class="button-group radius">
                            <li><!-- Today -->
                                <a class="button" href="#" title="Today">today</a> <!-- end of: Today -->
                            </li><li> <!-- Week -->
                                <a class="button" href="#" title="Week">week</a> <!-- end of: Week -->
                            </li><li> <!-- Month -->
                                <a class="button" href="#" title="Month">month</a> <!-- end of: Month -->
                            </li><li> <!-- Year -->
                                <a class="button active" href="#" title="Year">year</a> <!-- end of: Year -->
                            </li><li> <!-- All time -->
                                <a class="button" href="#" title="All time">all time</a> <!-- end of: All time -->
                            </li><li><!-- Date range -->
                                <!--<button>sfsdfdsfsd</button>-->
                                <a id="dateRange" class="button button-calendar" href="#" title="Date range">12/08/2015 - 31/08/2015 <i class="fa fa-calendar"></i></a>  
                                <!-- end of: Date range  -->
                            </li>
                            
                        </ul> <!-- end of stat filters -->
                        
                        <div class="row" data-equalizer>
                            <!-- Summary -->
                            <div class="large-3 column text-center summary-wrapper" data-equalizer-watch>
                                <div class="summary-label">
                                    <span class="summary__total"><?php echo $total_count; ?></span>
                                    <span class="summary__legend">TOTAL ORDERS</span>
                                    <span class="summary__date">2015</span>
                                </div>
                            </div> <!-- end of: Summary -->
                            
                            <!-- Chart -->
                            <div class="large-9 column" data-equalizer-watch>
                                <canvas id="statCanvas1" style="width: 100%; height: 200px;"></canvas>
                                <div id="chartjs-tooltip"></div>
                            </div> <!-- end of: Chart -->
                        </diV>
                    </article>
                </div> <!-- end of #dashboard -->
	        </div>
			<!-- end of tabs content -->
	    </div>
	</main>

<?php
	$this->load->view("_partials/footer.php");
?>