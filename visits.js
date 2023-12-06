
path_url_host = jQuery(location).attr('hostname');
path_url = 'https://' + path_url_host + '/';

	//////////////////////////////////////////////////////////////////
	function tabLoadEventHandler() {
		let hash = 'tab_' + +new Date();
		sessionStorage.setItem('TabHash',hash);
		let tabs = JSON.parse(localStorage.getItem('TabsOpen')||'{}');
		tabs[hash]=true;
		localStorage.setItem('TabsOpen',JSON.stringify(tabs));
	}
	function tabUnloadEventHandler() {
		let hash= sessionStorage.getItem('TabHash');
		let tabs = JSON.parse(localStorage.getItem('TabsOpen')||'{}');
		delete tabs[hash];
		localStorage.setItem('TabsOpen',JSON.stringify(tabs));
	}
	function tabsCount(){
		return Object.keys( JSON.parse(localStorage.getItem('TabsOpen')||'{}') ).length;
	}
	//////////////////////////////////////////////////////////////////
	function navigationType() {

		var result;
		var p;

		if (window.performance.navigation) {
			result = window.performance.navigation;
			if (result == 255) {
				result = 4
			} 
		}

		if (window.performance.getEntriesByType("navigation")) {
			p = window.performance.getEntriesByType("navigation")[0].type;

			if (p == 'navigate') {
				result = 0
			}
			if (p == 'reload') {
				result = 1
			}
			if (p == 'back_forward') {
				result = 2
			}
			if (p == 'prerender') {
				result = 3
			} 
		}
		return result;
	}

	window.onload = function() {
		tabLoadEventHandler();
		if (navigationType() == 0) {
			jQuery.ajax({
				type: "GET",
				url: path_url + "visits_counter/visit_sess.php",
				error: function(er) {
					console.log(er);
				},
				success: function(html) {
				}
			});
			jQuery.ajax({
				type: "GET",
				url: path_url + "visits_counter/counter.php",
				error: function(er) {
					console.log(er);
				},
				success: function(html) {
				}
			});
			jQuery.ajax({
				type: "GET",
				url: path_url + "visits_counter/time_visit.php",
				error: function(er) {
					console.log(er);
				},
				success: function(html) {
				}
			});
		}
	};

	window.onbeforeunload = function() {
		
		tabUnloadEventHandler();
			jQuery.ajax({
				type: "GET",
				url: path_url + "visits_counter/visit_sess_minus.php?count="+tabsCount(),
				error: function(er) {
				},
				success: function(res) {
					
				}
			});
		
	};