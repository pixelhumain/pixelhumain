<!-- start: SUBVIEW SAMPLE CONTENTS -->

<!-- *** Ajax Test *** -->
<div id="ajaxSV" class="no-display"></div>
<div id="meterNavigatorSV" class="no-display"></div>
<!-- *** READ NOTE *** -->

<!-- *** SHOW CALENDAR *** -->
<div id="showCalendar" class="col-md-10 col-md-offset-1">
	<div class="barTopSubview">
		<?php /* ?><a href="#addTaskForm" class="new-task button-sv" data-subviews-options='{"onShow": "bindTaskEvents();"}'><i class="fa fa-plus"></i> Add new Task</a>*/?>
	</div>
	<div id="calendar"></div>
</div>
<!-- *** NEW EVENT *** -->
<div id="newEvent">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h3>Add new event</h3>
		<form class="form-event">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input class="event-id hide" type="text">
						<input class="event-name form-control" name="eventName" type="text" placeholder="Event Name...">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<input type="checkbox" class="all-day" data-label-text="All-Day" data-on-text="True" data-off-text="False">
					</div>
				</div>
				<div class="no-all-day-range">
					<div class="col-md-8">
						<div class="form-group">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="event-range-date form-control" name="eventRangeDate" placeholder="Range date"/>
									<i class="fa fa-clock-o"></i> </span>
							</div>
						</div>
					</div>
				</div>
				<div class="all-day-range">
					<div class="col-md-8">
						<div class="form-group">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="event-range-date form-control" name="ad_eventRangeDate" placeholder="Range date"/>
									<i class="fa fa-calendar"></i> </span>
							</div>
						</div>
					</div>
				</div>
				<div class="hide">
					<input type="text" class="event-start-date" name="eventStartDate"/>
					<input type="text" class="event-end-date" name="eventEndDate"/>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<select class="form-control selectpicker event-categories">
							<option data-content="<span class='event-category event-cancelled'>Cancelled</span>" value="event-cancelled">Cancelled</option>
							<option data-content="<span class='event-category event-home'>Home</span>" value="event-home">Home</option>
							<option data-content="<span class='event-category event-overtime'>Overtime</span>" value="event-overtime">Overtime</option>
							<option data-content="<span class='event-category event-generic'>Generic</span>" value="event-generic" selected="selected">Generic</option>
							<option data-content="<span class='event-category event-job'>Job</span>" value="event-job">Job</option>
							<option data-content="<span class='event-category event-offsite'>Off-site work</span>" value="event-offsite">Off-site work</option>
							<option data-content="<span class='event-category event-todo'>To Do</span>" value="event-todo">To Do</option>
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<textarea class="summernote" placeholder="Write note here..."></textarea>
					</div>
				</div>
			</div>
			<div class="pull-right">
				<div class="btn-group">
					<a href="#" class="btn btn-info close-subview-button">
						Close
					</a>
				</div>
				<div class="btn-group">
					<button class="btn btn-info save-new-event" type="submit">
						Save
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- *** READ EVENT *** -->
<div id="readEvent">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<div class="row">
			<div class="col-md-12">
				<h2 class="event-title">Event Title</h2>
				<div class="btn-group options-toggle pull-right">
					<button class="btn dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
						<i class="fa fa-cog"></i>
						<span class="caret"></span>
					</button>
					<ul role="menu" class="dropdown-menu dropdown-light pull-right">
						<li>
							<a href="#newEvent" class="edit-event">
								<i class="fa fa-pencil"></i> Edit
							</a>
						</li>
						<li>
							<a href="#" class="delete-event">
								<i class="fa fa-times"></i> Delete
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<span class="event-category event-cancelled">Cancelled</span>
				<span class="event-allday"><i class='fa fa-check'></i> All-Day</span>
			</div>
			<div class="col-md-12">
				<div class="event-start">
					<div class="event-day"></div>
					<div class="event-date"></div>
					<div class="event-time"></div>
				</div>
				<div class="event-end"></div>
			</div>
			<div class="col-md-12">
				<div class="event-content"></div>
			</div>
		</div>
	</div>
</div>
<!-- *** NEW CONTRIBUTOR *** -->
<div id="newContributor">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h3>Add new contributor</h3>
		<form class="form-contributor">
			<div class="row">
				<div class="col-md-12">
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
					</div>
					<div class="successHandler alert alert-success no-display">
						<i class="fa fa-ok"></i> Your form validation is successful!
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input class="contributor-id hide" type="text">
						<label class="control-label">
							First Name <span class="symbol required"></span>
						</label>
						<input type="text" placeholder="Insert your First Name" class="form-control contributor-firstname" name="firstname">
					</div>
					<div class="form-group">
						<label class="control-label">
							Last Name <span class="symbol required"></span>
						</label>
						<input type="text" placeholder="Insert your Last Name" class="form-control contributor-lastname" name="lastname">
					</div>
					<div class="form-group">
						<label class="control-label">
							Email Address <span class="symbol required"></span>
						</label>
						<input type="email" placeholder="Text Field" class="form-control contributor-email" name="email">
					</div>
					<div class="form-group">
						<label class="control-label">
							Password <span class="symbol required"></span>
						</label>
						<input type="password" class="form-control contributor-password" name="password">
					</div>
					<div class="form-group">
						<label class="control-label">
							Confirm Password <span class="symbol required"></span>
						</label>
						<input type="password" class="form-control contributor-password-again" name="password_again">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							Gender <span class="symbol required"></span>
						</label>
						<div>
							<label class="radio-inline">
								<input type="radio" class="grey contributor-gender" value="F" name="gender">
								Female
							</label>
							<label class="radio-inline">
								<input type="radio" class="grey contributor-gender" value="M" name="gender">
								Male
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">
							Permits <span class="symbol required"></span>
						</label>
						<select name="permits" class="form-control contributor-permits" >
							<option value="View and Edit">View and Edit</option>
							<option value="View Only">View Only</option>
						</select>
					</div>
					<div class="form-group">
						<div class="fileupload fileupload-new contributor-avatar" data-provides="fileupload">
							<div class="fileupload-new thumbnail"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/anonymous.jpg" alt="" width="50" height="50"/>
							</div>
							<div class="fileupload-preview fileupload-exists thumbnail"></div>
							<div class="contributor-avatar-options">
								<span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
									<input type="file">
								</span>
								<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
									<i class="fa fa-times"></i> Remove
								</a>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">
							SEND MESSAGE (Optional)
						</label>
						<textarea class="form-control contributor-message"></textarea>
					</div>
				</div>
			</div>
			<div class="pull-right">
				<div class="btn-group">
					<a href="#" class="btn btn-info close-subview-button">
						Close
					</a>
				</div>
				<div class="btn-group">
					<button class="btn btn-info save-contributor" type="submit">
						Save
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- *** SHOW CONTRIBUTORS *** -->
<div id="showContributors">
	<div class="barTopSubview">
		<a href="#newContributor" class="new-contributor button-sv"><i class="fa fa-plus"></i> Add new contributor</a>
	</div>
	<div class="noteWrap col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-body">
				<div id="contributors">
					<div class="options-contributors hide">
						<div class="btn-group">
							<button class="btn dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
								<i class="fa fa-cog"></i>
								<span class="caret"></span>
							</button>
							<ul role="menu" class="dropdown-menu dropdown-light pull-right">
								<li>
									<a href="#newContributor" class="show-subviews edit-contributor">
										<i class="fa fa-pencil"></i> Edit
									</a>
								</li>
								<li>
									<a href="#" class="delete-contributor">
										<i class="fa fa-times"></i> Delete
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end: SUBVIEW SAMPLE CONTENTS -->