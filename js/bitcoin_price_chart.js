var MiningProfitBTCChart = {

	major_color: '#428bca',
	initial_range: '1d',
	initial_exchange: '',
	chart_width: 750,
	chart_height: 390, //chart with control
	chart_ranges: ['6h', '12h', '1d', '1w', '1m', '3m', '1y', 'All'],
	chart_exchanges: ['bitstamp'],
	active_exchanges: [],
	exchanges_variants: {
		bitstamp: {color: '#428bca', name: 'Bitstamp'},
		coinbase: {color: '#404d94', name: 'Coinbase'},
		bitfinex: {color: '#e15656', name: 'Bitfinex'},
		okcoin: {color: '#424c5c', name: 'OKCoin'},
		anxpro: {color: '#c01e28', name: 'ANX'}
	},
	is_visible_ranges: true,
	is_visible_interval: true,
	is_visible_exchanges: false,
	is_show_logo: true,

	api_url: 'https://mining-profit.com/api/btc-chart',
	control_height: 40,
	norm_period_update: 5*60, //5 minutes
	length_one_range: 33,
	max_length_interv: 320,
	left_step_chart: '50', //special to extension
	name_colors: ['white', 'silver', 'gray', 'black', 'red', 'maroon', 'yellow', 'olive', 'lime', 'green', 'aqua', 'teal', 'blue', 'navy', 'fuchsia', 'purple'],
	coef_logo: 0.2,

	//variable values:
	current_range: null,
	data_chart: null,
	options_chart: null,
	chart: null,
	timezone: null,
	formatter_date: null,

	is_not_normalized: true,
	is_compact_control: false,
	is_compact_interval: false,

	setMajorColor: function(custom_color) {
		var tmp_buffer = this.checkIsRightColor(custom_color);
		if (tmp_buffer) {
			this.major_color = tmp_buffer;
		}
	},

	setInitialRange: function(custom_range) {
		if (this.checkIsRightRange(custom_range)) {
			this.initial_range = custom_range;
		}
	},

	setInitialExchange: function(custom_exchange) {
		if ((typeof custom_exchange === 'string') && (this.exchanges_variants.hasOwnProperty(custom_exchange))) {
			this.initial_exchange = custom_exchange;
		}
	},

	setChartWidth: function(custom_width) {
		var c_w = parseInt(custom_width);
		if (!isNaN(c_w)) {
			this.chart_width = c_w;    
		}
	},

	setChartHeight: function(custom_height) {
		var c_h = parseInt(custom_height, 10);
		if (!isNaN(c_h)) {
			this.chart_height = c_h;
		}
	},

	setChartRanges: function(custom_ranges) {
		if (Object.prototype.toString.call(custom_ranges) === '[object Array]') {
			var buffer = [];
			for (var i = 0; i < custom_ranges.length; i++) {
				if (this.checkIsRightRange(custom_ranges[i])) {
					buffer.push(custom_ranges[i]);
				}
			}
			if (buffer.length > 0) {
				this.chart_ranges = [];
				this.chart_ranges.push(buffer[0]);
				for (var i = 1; i < buffer.length; i++) {
					var is_unique = true;
					for (var j = 0; j < this.chart_ranges.length; j++) {
						if (this.chart_ranges[j] == buffer[i]) {
							is_unique = false;
						}
					}
					if (is_unique) {
						this.chart_ranges.push(buffer[i]);
					}
				}
			}
		}
	},

	setChartExchanges: function(custom_exchanges) {
		if (Object.prototype.toString.call(custom_exchanges) === '[object Array]') {
			var buffer = [];
			var cnt_custom_exhanges = custom_exchanges.length;
			for (var i = 0; i < cnt_custom_exhanges; i++) {
				if (typeof custom_exchanges[i] === 'string') {
					var lower_exchange = custom_exchanges[i].toLowerCase();
					if (this.exchanges_variants.hasOwnProperty(lower_exchange)) {
						buffer.push(lower_exchange);
					}
				}
				else if ((custom_exchanges[i] !== null) && (typeof custom_exchanges[i] === 'object')) {
					for (var one_with_color in custom_exchanges[i]) {
						var lower_exchange = one_with_color.toLowerCase();
						if (this.exchanges_variants.hasOwnProperty(lower_exchange)) {
							buffer.push(lower_exchange);
							var check_color = this.checkIsRightColor(custom_exchanges[i][one_with_color]);
							if (check_color) {
								this.exchanges_variants[lower_exchange].color = check_color;
							}
						}
					}
				}
			}
			if (buffer.length > 0) {
				this.chart_exchanges = buffer;
				if (buffer.length > 1) {
					this.is_visible_exchanges = true;
				}
			}
		}
	},

	isDisplayControlRanges: function(flag){
		if (typeof flag === 'boolean') {
			this.is_visible_ranges = flag;	
		}
		else {
			this.is_visible_ranges = (flag) ? true : false;
		}
	},

	isDisplayControlInterval: function(flag) {
		if (typeof flag === 'boolean') {
			this.is_visible_interval = flag;
		}
		else {
			this.is_visible_interval = (flag) ? true : false;
		}
	},

	lastValidation: function() {
		if (this.is_visible_ranges && this.is_visible_interval) {
			var length_control = this.length_one_range*this.chart_ranges.length + this.max_length_interv;
			if (this.chart_width - length_control < 15) {
				this.is_compact_control = true;
				this.control_height = 70;
			}   
		}

		if (this.is_visible_exchanges && (this.is_visible_interval || this.is_visible_ranges)) {
			this.control_height += 40;
		}

		if (this.is_visible_interval || this.is_visible_ranges || this.is_visible_exchanges) {
			this.chart_height -= this.control_height;
		}

		if (this.is_visible_ranges) {
			if (this.chart_ranges.indexOf(this.initial_range) == -1) {
				this.initial_range = this.chart_ranges[0];
			}
		}

		if (this.is_visible_interval) {
			if (this.max_length_interv > this.chart_width) {
				this.is_compact_interval = true;
			}
		}

		if (this.chart_exchanges.indexOf(this.initial_exchange) == -1) {
			this.initial_exchange = this.chart_exchanges[0];
		}
		this.active_exchanges.push(this.initial_exchange);

		if (this.chart_exchanges.length == 1) {
			this.exchanges_variants[this.initial_exchange].color = this.major_color;
		}
	},

	checkIsRightRange: function(rr) {
		if ((typeof rr === 'string') && (rr.length > 1)) {
			if (rr == 'All') {
				return true;
			}
			else {
				var j = 0; var rng_digit = ''; 
				while (!isNaN(parseFloat(rr[j])) && isFinite(rr[j])) {
					rng_digit += rr[j];
					j += 1;
				}
				if ((j != 0) && (rng_digit[0] != '0')) {
					var rng_name = rr.slice(j, rr.length);
					if ((rng_name.length == 1) && ('hdwmy'.indexOf(rng_name) != -1)) {
						return true;
					}
				}
			}
		}
		return false;
	},

	checkIsRightColor: function(color) {
		var result_color = null;
		if (typeof color === 'string') {
			if (/^#([a-f0-9]{6}|[a-f0-9]{3})$/i.test(color)) {
				result_color = color;
			}
			else if (/^rgb\( *[0-9]{1,3}, *[0-9]{1,3}, *[0-9]{1,3}\)$/.test(color)) {
				var reg_result = /^rgb\( *([0-9]{1,3}), *([0-9]{1,3}), *([0-9]{1,3})\)$/.exec(color);
				result_color = 'rgb('
				for (var i = 1; i <= 3; i++) {
					var buff_part_color = parseInt(reg_result[i]);
					result_color += (buff_part_color > 255) ? '255' : buff_part_color;
					if (i != 3) {
						result_color += ',';
					}
				}
				result_color += ')';
			}
			else {
				var low_custom_color = color.toLowerCase();
				if (this.name_colors.indexOf(low_custom_color) != -1) {
					result_color = low_custom_color;
				}
			}
		}
		return result_color;
	},

	sendRequest: function() {
		var req = new XMLHttpRequest;
		req.open('GET', this.api_url+'?range='+this.current_range+'&exchanges='+JSON.stringify(this.active_exchanges), true);
		req.onload  = this.updateChart.bind(this);
		req.send(null);
	},

	sendRequestForOneEchange: function(name_exchange) {
		var req = new XMLHttpRequest;
		req.open('GET', this.api_url+'?range='+this.current_range+'&exchanges='+JSON.stringify([name_exchange]), true);
		req.onload = this.addOneEchange.bind(null, name_exchange);
		req.send(null);
	},

	initialChart: function() {
		var user_time = new Date();
		var self = MiningProfitBTCChart;
		self.timezone = user_time.getTimezoneOffset();
		self.formatter_date = new google.visualization.DateFormat({pattern: "d MMM yyyy"});
		self.chart = new google.visualization.LineChart(document.getElementById('mpbtcchart_chart_price'));
		var add_option_inner = (self.chart_height < 340)?'in':'out';
		self.options_chart = {
			vAxis: {
				textStyle: {color: '#909090'},
				baselineColor: '#909090'
			},
			hAxis: {
				textStyle: {color: '#909090'},
				gridlines: {color: '#fff'},
				baselineColor: '#fff',
				textPosition: add_option_inner
			},
			color: self.major_color,
			colors: [self.exchanges_variants[self.initial_exchange].color],
			crosshair: {trigger: 'both', orientation: 'vertical'},
			focusTarget: 'category',
			legend: {position: 'none'},
			chartArea: {width: '95%', height: '90%', left: self.left_step_chart},
			interpolateNulls: true
		};
		self.sendRequest();
	},

	configureUpdate: function(last_date_timest, r_part) {
		if (r_part && ('hd'.indexOf(r_part.rname) != -1)) {
			this.is_not_normalized = false;
			var second_reserv = 30;
			var time_now = new Date();
			var rest_time = this.norm_period_update*1000 - (time_now - last_date_timest*1000) + second_reserv*1000;
			setTimeout(function(){
				var part_r1 = MiningProfitBTCChart.getSimplePartRange();
				if (part_r1 && ('hdw'.indexOf(part_r1.rname) != -1)) {
					MiningProfitBTCChart.sendRequest();
				}
				setInterval(function(){
					var part_r2 = MiningProfitBTCChart.getSimplePartRange();
					if (part_r2 && ('hdw'.indexOf(part_r2.rname) != -1)) {
						MiningProfitBTCChart.sendRequest();
					}
				}, MiningProfitBTCChart.norm_period_update*1000);
			}, rest_time);
		}
	},

	updateChart: function(e) {
		var msg = JSON.parse(e.target.responseText);
		var points = JSON.parse(msg.prices);
		var start_of_range = msg.start_of_range;
		var range_part = this.getSimplePartRange();

		this.data_chart = new google.visualization.DataTable();
		this.data_chart.addColumn('datetime', 'Date');

		var cnt_active_exch = this.active_exchanges.length;
		for (var j = 0; j < cnt_active_exch; j++) {
			this.data_chart.addColumn('number', this.active_exchanges[j]);
		}
		var count_hours = this.getCountHours(start_of_range);

		var times_list = {};

		if (range_part && ('hdw'.indexOf(range_part.rname) != -1)) {
			for (var i = 0; i < cnt_active_exch; i++) {
				var tmp_count = points[this.active_exchanges[i]].length;
				for (var k = 0; k < tmp_count; k++) {
					var item = points[this.active_exchanges[i]][k];
					if (times_list.hasOwnProperty(item.date)) {
						times_list[item.date][i] = item.price;
					}
					else {
						times_list[item.date] = [];
						times_list[item.date][i] = item.price;
					}
				}
			}
		}
		else {
			for (var i = 0; i < cnt_active_exch; i++) {
				var tmp_count = points[this.active_exchanges[i]].length;
				for (var k = 0; k < tmp_count; k++) {
					var item = points[this.active_exchanges[i]][k];
					if (times_list.hasOwnProperty(item.date)) {
						times_list[item.date][i] = item.btc_price;
					}
					else {
						times_list[item.date] = [];
						times_list[item.date][i] = item.btc_price;
					}					
				}
			}
		}

		var times_sorted = {};
		var keys_times = [];
		for (var kp in times_list) keys_times.push(kp);

		if (range_part && ('hdw'.indexOf(range_part.rname) != -1)) {
			keys_times = keys_times.sort(function(a, b){return a-b});
		}
		else {
			keys_times = keys_times.sort(
				function(a, b) {
					for (var c = 0; c < a.length; c++) {
						if (parseInt(a[c]) < parseInt(b[c])) {
							return -1;
						}
						else if (parseInt(a[c]) > parseInt(b[c])) {
							return 1;
						}
					}
					return 0;
				}
			);
		}

		var cnt_keys_times = keys_times.length; 
		for (var j = 0; j < cnt_keys_times; j++) {
			times_sorted[keys_times[j]] = times_list[keys_times[j]];
		}

		if (this.is_not_normalized) {
			this.configureUpdate(keys_times[cnt_keys_times - 1], range_part);
		}

		if (range_part && ('hdw'.indexOf(range_part.rname) != -1)) {
			for (var key_date in times_sorted) {
				var date_from_timestamp = new Date(key_date*1000);
				var oneRow = [new Date(date_from_timestamp.setMinutes(date_from_timestamp.getMinutes()+this.timezone))];

				for (var s = 0; s < cnt_active_exch; s++) {
					if (times_sorted[key_date][s]) {
						oneRow.push(times_sorted[key_date][s]);
					}
					else {
						oneRow.push(null);
					}
				}
				this.data_chart.addRow(oneRow);
			}
		}
		else {
			for (var key_date in times_sorted) {
				var date_from_timestamp = new Date(key_date);
				var oneRow = [new Date(date_from_timestamp.setMinutes(date_from_timestamp.getMinutes()+this.timezone))];

				for (var s = 0; s < cnt_active_exch; s++) {
					if (times_sorted[key_date][s]) {
						oneRow.push(times_sorted[key_date][s]);
					}
					else {
						oneRow.push(null);
					}
				}
				this.data_chart.addRow(oneRow);
			}
			this.formatter_date.format(this.data_chart, 0);
		}

		var less_grid = (this.chart_width < 750) ? 2 : 1;
		if (count_hours <= 24) { //less then 1 day
			this.options_chart.hAxis.format = "HH:mm";
			this.options_chart.hAxis.gridlines.count = parseInt(12/less_grid);
		}
		else if (count_hours <= 8784) {//less then 1 year
			this.options_chart.hAxis.format = "MMM d";
			this.options_chart.hAxis.gridlines.count = parseInt(8/less_grid);
		}
		else {
			this.options_chart.hAxis.format = "y MMM";
			this.options_chart.hAxis.gridlines.count = parseInt(8/less_grid);
		}
		if (this.is_visible_interval) {
			this.updatesDatesInterval(start_of_range, count_hours);
		}
		this.chart.draw(this.data_chart, this.options_chart);
	},

	addOneEchange: function(exchange, e) {
		var msg = JSON.parse(e.target.responseText);
		var points = JSON.parse(msg.prices);
		points = points[exchange];
		var self = MiningProfitBTCChart;

		self.data_chart.addColumn('number', exchange);

		var index_new_column = self.data_chart.getNumberOfColumns() - 1;
		var curr_count_rows = self.data_chart.getNumberOfRows();
		var count_points = points.length;

		var datatable_cursor = 0;
		var range_part = self.getSimplePartRange();
		var is_days_range = false;

		if (( ! range_part) || ('hdw'.indexOf(range_part.rname) == -1)) {
			var buff_points = [];
			for (var h = 0; h < count_points; h++) {
				buff_points.push({
					price: points[h].btc_price,
					date_str: points[h].date,
					date: Date.parse(points[h].date)/1000
				});
			}
			points = buff_points.reverse();
			is_days_range = true;
		}

		var points_cursor = 0;
		var flag_process_new_date = true;
		var time_to_compare;

		while (points_cursor < count_points) {
			if (datatable_cursor < curr_count_rows) {
				if (flag_process_new_date) {
					time_to_compare = (self.data_chart.getValue(datatable_cursor, 0).getTime())/1000 - (self.timezone*60);
					flag_process_new_date = false;
				}
				if (points[points_cursor].date < time_to_compare) {
					var date_from_timestamp = new Date(points[points_cursor].date*1000);
					var oneRow = [new Date(date_from_timestamp.setMinutes(date_from_timestamp.getMinutes()+self.timezone))];
					for (var i = 1; i < index_new_column; i++) {
						oneRow.push(null);
					}
					oneRow.push(points[points_cursor].price);
					self.data_chart.insertRows(datatable_cursor, [oneRow]);
					curr_count_rows += 1;
					points_cursor += 1;
				}
				else if (points[points_cursor].date == time_to_compare) {
					self.data_chart.setCell(datatable_cursor, index_new_column, points[points_cursor].price);
					points_cursor += 1;
					flag_process_new_date = true;
				}
				else {
					flag_process_new_date = true;   
				}
				datatable_cursor += 1;
			}
			else {
				if (is_days_range) {
					var date_from_timestamp = new Date(points[points_cursor].date_str);    
				}
				else {
					var date_from_timestamp = new Date(points[points_cursor].date*1000);
				}
				var oneRow = [new Date(date_from_timestamp.setMinutes(date_from_timestamp.getMinutes()+this.timezone))];
				for (var i = 1; i < index_new_column; i++) {
					oneRow.push(null);
				}
				oneRow.push(points[points_cursor].price);
				self.data_chart.addRow(oneRow);
				points_cursor += 1;
			}
		}
		self.chart.draw(self.data_chart, self.options_chart);
	},

	deleteOneExchange: function(name_exchange) {
		var index_column = 0;
		var cnt_columns = this.data_chart.getNumberOfColumns();
		for (var i = 1; i < cnt_columns; i++) {
			if (name_exchange == this.data_chart.getColumnLabel(i)) {
				index_column = i;
				break;
			}
		}
		if (index_column) {
			this.data_chart.removeColumn(index_column);
			this.chart.draw(this.data_chart, this.options_chart);
		}
	},

	draw: function(){
		this.lastValidation();
		this.current_range = this.initial_range;
		var clr = this.major_color; var wdt = this.chart_width;
		var hgt_ch = this.chart_height;
		var chart_script = ''+
			'<script type="text/javascript" src="https://www.google.com/jsapi"><\x2fscript>'+
			'<script type="text/javascript">'+
				'google.load("visualization", "1", {packages: ["corechart"]});'+
				'google.setOnLoadCallback(MiningProfitBTCChart.initialChart);'+
			'<\x2fscript>';
		var chart_style = ''+
			'<style>'+
			'#mpbtcchart_container{position:relative;border:0;border-radius:0;padding:0;margin:0;box-sizing:border-box;'+
				'-moz-box-sizing:border-box;-webkit-box-sizing:border-box;width:'+wdt+'px;}'+
			'#mpbtcchart_container *{border:0;border-radius:0;padding:0;margin:0;box-sizing:border-box;'+
				'-moz-box-sizing:border-box;-webkit-box-sizing:border-box;}'+
			'#mpbtcchart_container .mpchart-clear-flow:after{content:" ";display:block;clear:both;}';
		chart_style += (this.is_visible_exchanges) ? this.addStyleControlExchanges() : '';
		chart_style += (this.is_show_logo) ? this.addStyleLogo() : '';
		if (this.is_visible_ranges) {
			var range_pos_style = (this.is_compact_control) ? 'margin-bottom:6px;' : '';
			chart_style += ''+
				'#mpbtcchart_container .choose-range-chart{border-style:solid;border-color:'+clr+';border-width:1px 0 1px 1px;float:left;'+range_pos_style+'}'+
				'#mpbtcchart_container .varr-range{font:normal 400 14px Helvetica,sans-serif;color:'+clr+';text-align:center;width:33px;border-right:1px solid '+clr+';float:left;line-height:22px;cursor:pointer;}'+
				'#mpbtcchart_container .varr-range:hover{background-color:'+clr+';color:#fff;}'+
				'#mpbtcchart_container .varr-range.active-choose{color:#fff;background-color:'+clr+';}';
		}
		if (this.is_visible_interval) {
			var interv_pos_style = (this.is_compact_control) ? 'float:none;clear:both;' : 'float:right;';
			var l_part_interv_st = (this.is_compact_interval) ? 'clear:both;' : '';
			chart_style += ''+
				'#mpbtcchart_container .curr-range-chart{'+interv_pos_style+'}'+
				'#mpbtcchart_container .curr-range-chart > div{padding:0 7px;float:left;font:normal 400 14px/22px Helvetica,sans-serif;text-align:center;color:'+clr+'}'+
				'#mpbtcchart_container #mpchart_curr_r_c_from, #mpbtcchart_container #mpchart_curr_r_c_to{border:1px solid '+clr+'; padding:0 12px;}'+
				'#mpbtcchart_container #mpchart_curr_r_c_to{'+l_part_interv_st+'}';
		}
		chart_style += ''+
			'#mpbtcchart_container #mpbtcchart_chart_price{width:'+wdt+'px;height:'+hgt_ch+'px;}'+
			'</style>';
		var chart_html = '<div id="mpbtcchart_container">';
		chart_html += this.drawControlPanel();
		chart_html += '<div id="mpbtcchart_chart_price"></div>';
// 		chart_html += (this.is_show_logo) ? this.drawMPLogo() : '';
		chart_html += '</div>';
		document.write(chart_script + chart_style + chart_html);
		this.trackChart();
	},

	addStyleControlExchanges: function() {
		var exchange_style = ''+
			'#mpbtcchart_container .mpchart-exchanges-chart{display:inline-block;margin-bottom:12px;border-left:1px solid '+this.major_color+';}'+
			'#mpbtcchart_container .mpchart-exchange-choose{display:inline-block;margin:0;padding:0 6px;cursor:pointer;font-size:14px;line-height:22px;color:'+this.major_color+';border-right:1px solid '+this.major_color+';border-top:1px solid '+this.major_color+';border-bottom:1px solid '+this.major_color+';background-color:#fff;}';
		return exchange_style;
	},

	addStyleLogo: function() {
		var logo_width = 221, logo_height = 50, draw_logo_width, draw_logo_height;
		var logo_ratio = logo_width/logo_height;
		var chart_ratio = this.chart_width/this.chart_height;
		if (logo_ratio >= chart_ratio) {
			draw_logo_width = this.chart_width*this.coef_logo;
			if (draw_logo_width >= logo_width) {
				draw_logo_width = logo_width;
				draw_logo_height = logo_height;
			}
			else {
				draw_logo_height = logo_height*(draw_logo_width/logo_width);
			}
		}
		else {
			draw_logo_height = this.chart_height*this.coef_logo;
			if (draw_logo_height >= logo_height) {
				draw_logo_width = logo_width;
				draw_logo_height = logo_height;
			}
			else {
				draw_logo_width = logo_width*(draw_logo_height/logo_height);
			}
		}
		var from_bottom = this.chart_height - draw_logo_height;
		var logo_style = ''+
			'#mpbtcchart_container #mpbtcchart_logo{position:absolute;display:block;background-color:white;width:'+parseInt(draw_logo_width)+'px;height:'+parseInt(draw_logo_height)+'px;right:0;bottom:'+parseInt(from_bottom)+'px;z-index:10000;}'+
			'#mpbtcchart_container #mpbtcchart_logo img{width:100%;height:100%;margin:0;padding:0;}';
		return logo_style;
	},

	drawControlPanel: function(){
		var html_result = '';
		if (this.is_visible_exchanges) {
			html_result += this.drawControlExchanges();
		}
		if (this.is_visible_ranges || this.is_visible_interval) {
			html_result += '<div class="controls-chart mpchart-clear-flow" style="margin-bottom: 16px;">';
			if (this.is_visible_ranges) {html_result += this.drawControlRanges();}
			if (this.is_visible_interval) {html_result += this.drawControlInterval();}
			html_result += '</div>';
		}
		return html_result;
	},

	drawControlExchanges: function() {
		var html_cntr_exch = '<div class="mpchart-exchanges-chart">';
		var cnt_exchanges = this.chart_exchanges.length;
		for (var i = 0; i < cnt_exchanges; i++) {
			var add_active_style = '';
			if (this.chart_exchanges[i] === this.initial_exchange) {
				add_active_style = 'style="background-color:'+this.exchanges_variants[this.chart_exchanges[i]].color+';color:#fff;"';
			}
			html_cntr_exch += '<div id="'+this.chart_exchanges[i]+'" class="mpchart-exchange-choose" '+add_active_style+' onclick="MiningProfitBTCChart.chooseExchange(this)" onmouseover="MiningProfitBTCChart.moveOnExchange(this)" onmouseleave="MiningProfitBTCChart.leaveFromExchange(this)">'+this.exchanges_variants[this.chart_exchanges[i]].name+'</div>';
		}
		html_cntr_exch += '</div>';
		return html_cntr_exch;
	},

	drawControlRanges: function(){
		var html_result = '<div class="choose-range-chart mpchart-clear-flow">';
		for (var i = 0; i < this.chart_ranges.length; i++) {
			if (this.chart_ranges[i] == this.initial_range) {
				html_result += '<div id="mpchart-'+this.chart_ranges[i]+'" '+
					'onclick="MiningProfitBTCChart.chooseRange(this)" '+
					'class="varr-range active-choose">'+this.chart_ranges[i]+'</div>';
			}
			else {
				html_result += '<div id="mpchart-'+this.chart_ranges[i]+'" '+
					'onclick="MiningProfitBTCChart.chooseRange(this)" '+
					'class="varr-range">'+this.chart_ranges[i]+'</div>';
			}
		}
		html_result += '</div>';
		return html_result;
	},

	drawControlInterval: function() {
		var d_start = new Date();
		d_start = d_start.toUTCString().split(' ');
		if (this.isRangeLessThanOneDay()) {
			d_start = [d_start[2], d_start[1], d_start[4].substring(0, 5)+',', d_start[3]].join(' ');
		}
		else {
			d_start = [d_start[2], d_start[1]+',', d_start[3]].join(' ');
		}
		var html_result = '<div class="curr-range-chart mpchart-clear-flow">'+
				'<div id="mpchart_curr_r_c_from"> --- </div>'+
				'<div>to</div>'+
				'<div id="mpchart_curr_r_c_to">'+d_start+'</div>'+
			'</div>';
		return html_result;
	},

// 	drawMPLogo: function() {
// 		return '<div id="mpbtcchart_logo"><a href="https://mining-profit.com/" target="_blank"><img src="'+this.logo_image+'" /></a></div>';
// 	},

	isRangeLessThanOneDay: function() {
		var range_split = this.getSimplePartRange();
		if (range_split) {
			if (range_split.rname == 'h' && range_split.rdigit < 24) {
				return true;
			}
			else {return false;}
		}
		else {return false;}
	},

	getSimplePartRange: function() {
		var range = this.current_range;
		if (range == 'All') {return 0;}
		else {
			var i = 0; 
			var range_digit = '';
			var range_name; 
			while (!isNaN(parseFloat(range[i])) && isFinite(range[i])) {
				range_digit += range[i];
				i += 1;
			}
			range_name = range.slice(i, range.length);
			return {'rdigit': parseInt(range_digit), 'rname': range_name};
		}
	},

	getCountHours: function(from_timestamp) {
		var to_timestamp = new Date();
		to_timestamp = (to_timestamp.setMilliseconds(0))/1000;
		return parseInt((to_timestamp-from_timestamp)/3600);
	},

	updatesDatesInterval: function(start_r, c_hours) {
		var d_from_str, d_to_str;

		var d_to = new Date();
		var d_to_arr = d_to.toUTCString().split(' ');

		var d_from = new Date(start_r*1000); 
		var d_from_arr = d_from.toUTCString().split(' ');

		if(c_hours < 24) {
			d_from_str = [d_from_arr[2], d_from_arr[1], d_from_arr[4].substring(0, 5)+',', d_from_arr[3]].join(' ');
			d_to_str = [d_to_arr[2], d_to_arr[1], d_to_arr[4].substring(0, 5)+',', d_to_arr[3]].join(' ');
		}
		else {
			d_from_str = [d_from_arr[2], d_from_arr[1]+',', d_from_arr[3]].join(' ');
			d_to_str = [d_to_arr[2], d_to_arr[1]+',', d_to_arr[3]].join(' ');
		}

		document.getElementById('mpchart_curr_r_c_from').innerHTML = d_from_str;
		document.getElementById('mpchart_curr_r_c_to').innerHTML = d_to_str;
	},

	chooseRange: function(elem) {
		var new_range = elem;
		var old_range = document.getElementById('mpbtcchart_container').getElementsByClassName('active-choose').item(0);
		if (new_range.innerHTML != old_range.innerHTML) {
			old_range.classList.remove('active-choose');
			new_range.classList.add('active-choose');
			this.current_range = new_range.innerHTML;
			this.sendRequest();
		}
	},

	chooseExchange: function(elem) {
		var name_exchange_click = elem.id;
		var index_in_active = this.active_exchanges.indexOf(name_exchange_click);
		if (index_in_active != -1) {
			if (this.active_exchanges.length != 1) {
				elem.style.backgroundColor = '#fff';
				elem.style.color = this.major_color;
				this.active_exchanges.splice(index_in_active, 1);
				this.options_chart.colors.splice(this.options_chart.colors.indexOf(this.exchanges_variants[name_exchange_click].color), 1);
				this.deleteOneExchange(name_exchange_click);
			}
		}
		else {
			elem.style.backgroundColor = this.exchanges_variants[name_exchange_click].color;
			elem.style.color = '#fff';
			this.active_exchanges.push(name_exchange_click);
			this.options_chart.colors.push(this.exchanges_variants[name_exchange_click].color);
			this.sendRequestForOneEchange(name_exchange_click);
		}
	},

	moveOnExchange: function(elem) {
		name_exchange_over = elem.id;
		if (this.active_exchanges.indexOf(name_exchange_over) == -1) {
			elem.style.backgroundColor = this.exchanges_variants[name_exchange_over].color;
			elem.style.color = '#fff';
		}
	},

	leaveFromExchange: function(elem) {
		name_exchange_leave = elem.id;
		if (this.active_exchanges.indexOf(name_exchange_leave) == -1) {
			elem.style.backgroundColor = '#fff';
			elem.style.color = this.major_color;
		}
	},

	trackChart: function() {
		var xmlhttp = new XMLHttpRequest;
		var srv_hostname = window.location.hostname;
		var srv_url = window.location.href;
		var params = 'srv_hostname=' + encodeURIComponent(srv_hostname) + '&srv_url=' + encodeURIComponent(srv_url);
		xmlhttp.open("POST", 'https://mining-profit.com/track-chart', true);
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlhttp.send(params);
	},

	logo_image: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAN0AAAAyCAIAAAEgs3mMAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QTQ0ODEwRUMyNTYzMTFFNTgxOUM4RDEzMkUwMTc0QjIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QTQ0ODEwRUQyNTYzMTFFNTgxOUM4RDEzMkUwMTc0QjIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpBNDQ4MTBFQTI1NjMxMUU1ODE5QzhEMTMyRTAxNzRCMiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpBNDQ4MTBFQjI1NjMxMUU1ODE5QzhEMTMyRTAxNzRCMiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PsbraxEAAB7DSURBVHjaYvz//z8D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"
};