
<div class="presentation-container row">
    <div class="slide_show col-sm-6 col-xs-12">
        <?php echo do_shortcode('[metaslider id="159"]'); ?>
    </div>

    <div class="col-sm-6 col-xs-12 client_search">
        <div class="premises-search">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Tenants</a></li>
                <li><a data-toggle="tab" href="#menu1">Oweners</a></li>
            </ul>
            <div id="tab-content" class="tab-content">
                <div id="content">
                    <div id="home" class="tab-pane fade in active">
                        <p style="padding: 10pt; margin-left: 10pt;">Address, Suburbs, Postcodes or Regions</p>
                        <input type="text" class="form-control" id="address" placeholder="Example: White House">
                        <div class="checkbox">
                            <label style="font-size: medium"><input type="checkbox" value="">Include surrounding suburbs</label>
                        </div>
                        <div class="form-group">
                            <label style="font-size: medium" for="sel_prop">Property type:</label>
                            <select class="form-control" id="sel_prop">
                                <option value="" disabled selected>Select one</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="font-size: medium" for="sel_prop">Bedrooms:</label>
                            <select class="form-control" id="sel_bedrooms">
                                <option value="" disabled selected>Select one</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                        <button type="button" class="btn" id="search_tenants">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
