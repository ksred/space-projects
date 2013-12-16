$(document).ready( function() {
	$(document).on('click', '.add-task', function() {
		$('#add-task-form .form-group').append('<input type="text" class="form-control" name="task[]" placeholder="Enter Task desc">');
		return false;
	});

	$(document).on('click', '.mark-done', function() {
		var status = $(this).parent().attr('data-done');
		var task = $(this).attr('data-id');
		if (status == 0) {
			var update = 1;
		} else {
			var update = 0;
		}
		$.ajax({ 
			url: '/tasks/change_status', 
			type: 'POST', 
			data: 'task='+task+'&status='+update, 
			dataType: 'JSON', 
			async: true, 
			success: function(data) { 
				if (status == 0) {
					$('[data-id="'+task+'"]').parent().attr('data-done', '1');
				} else {
					$('[data-id="'+task+'"]').parent().attr('data-done', '0');
				}
				getProgress();
			} 
		}); 
	});

	/*
		This is where the live updating comes in. There are many ways to do this, easiest is a poll using a timeout.
		Results are hardcached on server side, so no db call actually gets made. The cache gets updated only on change.
	*/
	setInterval( function() {
		var project = $('#project-id');
		//Only on single project page
		if (project.length > 0) {
			var project = project.attr('data-id');
			$.ajax({ 
				url: '/tasks/get_status', 
				type: 'POST', 
				data: 'project='+project, 
				dataType: 'JSON', 
				async: true, 
				success: function(data) { 
					if (data.changed == 1) {
						//For now, we can just refresh the page when a new task is added or removed
						if (data.tasks.length != $('.task').length) {
							location.reload();
						} else {
							$.each(data.tasks, function() {
								$('[data-id="'+this.id+'"]').parent().attr('data-done', this.status);
							});
							getProgress();
						}
					}
				} 
			}); 
		}//end single project
		var landing = $('.landing');
		console.log(landing.length);
		if (landing.length > 0) {
			$.each($('.project-list-item'), function() {
				var id = $(this).attr('data-id');
				$.ajax({ 
					url: '/projects/get_progress', 
					type: 'POST', 
					data: 'project='+id, 
					dataType: 'JSON', 
					async: true, 
					success: function(data) { 
						if (data.progress === 1) {
							var totalTasks = data.total;
							var totalDone = data.done;
							var percDone = data.perc;
							$('.project-list-item[data-id="'+id+'"] .progress-bar').css('width',  percDone+'%').attr('aria-valuenow', totalDone).attr('aria-valuemax', totalTasks);
							$('.project-list-item[data-id="'+id+'"] .progress-bar .sr-only').html(percDone+'% Complete');
						}
					} 
				}); 
			});//end each project
		}
	}, 5000); //Set this timeout at 5s for now

	function getProgress () {
		var totalTasks = $('.task').length;
		var totalDone = $('.task[data-done="1"]').length;
		var percDone = Math.round((parseInt(totalDone) / parseInt(totalTasks)) * 100);
		$('.project-single .progress-bar').css('width',  percDone+'%').attr('aria-valuenow', totalDone).attr('aria-valuemax', totalTasks);
		$('.project-single .progress-bar .sr-only').html(percDone+'% Complete');
	}

});
