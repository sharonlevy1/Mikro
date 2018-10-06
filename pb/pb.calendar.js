jQuery(function($){

	window.PB_CALENDAR_DEFAULTS = {
		'schedule_list' : function(callback_, yyyymm_){
			callback_({});
		},
		'schedule_dot_item_render' : function(dot_item_el_){
			return dot_item_el_;
		},
		'day_selectable' : false,
		'callback_selected_day' : $.noop,
		'callback_changed_month' : $.noop,
		'min_yyyymm' : null,
		'max_yyyymm' : null,
		'next_month_button' : '<img src="./img/arrow-next.png" class="icon">',
		'prev_month_button' : '<img src="./img/arrow-prev.png" class="icon">',

		'month_label_format' : "MMM",
		'year_label_format' : "YYYY",
	}

	var _pb_calendar = (function(target_, options_){
		this._target = $(target_);
		this._options = $.extend(PB_CALENDAR_DEFAULTS, options_);

		this._target.append('<div class="top-frame">' + 
			'<div class="year-month-frame">'+ 
				'<span class="year"></span>'+ 
				'<span class="month"></span>'+ 
			'</div>'+ 
			'<div class="control-frame">'+ 
				'<a href="#" class="control-btn prev-btn">'+this._options['prev_month_button']+'</a>'+ 
				'<a href="#" class="control-btn next-btn">'+this._options['next_month_button']+'</a>'+ 
			'</div>'+ 
		'</div>');

		this._target.append('<div class="calendar-head-frame">' +
			'<div class="row row-dayname">' +
				'<div class="col col-dayname holiday">SUN</div>' +
				'<div class="col col-dayname">MON</div>' +
				'<div class="col col-dayname">TUE</div>' +
				'<div class="col col-dayname">WED</div>' +
				'<div class="col col-dayname">THU</div>' +
				'<div class="col col-dayname">FRI</div>' +
				'<div class="col col-dayname">SAT</div>' +
			'</div>' +
		'</div>');

		this._target.append("<div class='calendar-body-frame'></div>");
		this._body_frame = this._target.children(".calendar-body-frame");

		var top_frame_el_ = this._target.children(".top-frame");
		var control_frame_el_ = top_frame_el_.children(".control-frame");

		this._year_label = top_frame_el_.find(".year-month-frame > .year");
		this._month_label = top_frame_el_.find(".year-month-frame > .month");

		this._prev_month_btn = control_frame_el_.find(".prev-btn");
		this._next_month_btn = control_frame_el_.find(".next-btn");

		this._prev_month_btn.click($.proxy(function(event_){
			var target_moment_ = this._yyyy_mm_moment.clone();
			target_moment_.subtract(1, "M");

			if(this._options['min_yyyymm']){
				if(target_moment_.isBefore(this._options['min_yyyymm'], 'month')){
					return false;
				}
			}

			this.yyyymm(target_moment_.format("YYYYMM"));
			return false;
		}, this));

		this._next_month_btn.click($.proxy(function(event_){
			var target_moment_ = this._yyyy_mm_moment.clone();
			target_moment_.add(1, "M");

			if(this._options['max_yyyymm']){
				if(target_moment_.isAfter(this._options['max_yyyymm'], 'month')){
					return false;
				}
			}

			this.yyyymm(target_moment_.format("YYYYMM"));
			return false;
		}, this));

		this._target.data('pb-calendar', this);

		if(this._options['min_yyyymm']){
			this.yyyymm(this._options['min_yyyymm'].format("YYYYMM"));	
		}else{
			this.yyyymm(moment().format("YYYYMM"));	
		}

		
	});

	_pb_calendar.prototype.yyyymm = (function(yyyymm_){
		if(yyyymm_ !== undefined){
			var before_yyyymm_ = null;
			if(this._yyyy_mm_moment){
				before_yyyymm_ = this._yyyy_mm_moment.format("YYYYMM");
			}

			this._yyyy_mm_moment = moment(yyyymm_, 'YYYYMM');	
			this.update_view();

			if(before_yyyymm_ && yyyymm_ !== before_yyyymm_){
				this._options['callback_changed_month'].apply(this, [yyyymm_, before_yyyymm_]);
			}

			if(this._options['min_yyyymm']){
				var toggle_ = this._yyyy_mm_moment.isSameOrBefore(this._options['min_yyyymm'], 'month');
				this._prev_month_btn.toggleClass("disabled", toggle_);
			}

			if(this._options['max_yyyymm']){
				var toggle_ = this._yyyy_mm_moment.isSameOrAfter(this._options['max_yyyymm'], 'month');
				this._next_month_btn.toggleClass("disabled", toggle_);
			}
		}

		return this._yyyy_mm_moment.format("YYYYMM");
	});

	_pb_calendar.prototype._schedule_list = (function(callback_){
		if(!$.isFunction(this._options['schedule_list'])){
			callback_.apply(this, [this._options['schedule_list']]);
			return;
		}

		this._options['schedule_list'].apply(this, [$.proxy(function(schedule_list_){
			this['callback'].apply(this['module'], [schedule_list_]);
		},{
			module : this,
			callback: callback_
		}), this._yyyy_mm_moment])
	});

	_pb_calendar.prototype.update_view = (function(){

		this._year_label.text(this._yyyy_mm_moment.format(this._options['year_label_format']));
		this._month_label.text(this._yyyy_mm_moment.format(this._options['month_label_format']));

		var yyyymm_ = this._yyyy_mm_moment;
		var yyyymm_num_ = parseInt(yyyymm_.format("YYYYMM"));

		var month_srt_moment_ = yyyymm_.clone();
			month_srt_moment_.date(1);

		var month_end_moment_ = yyyymm_.clone();
			month_end_moment_.date(31);

		if(month_end_moment_.format("MM") !== yyyymm_.format("MM")){
			month_end_moment_.subtract(1, "days");
		}

		var temp_srt_day_num_ = month_srt_moment_.format("E");
		var temp_end_day_num_ = month_end_moment_.format("E");
		month_srt_moment_.weekday(1).subtract(1,"days");
		month_end_moment_.weekday(7).subtract(1,"days");

		var day_count_ = month_end_moment_.diff(month_srt_moment_, "days");

		var target_moment_ = month_srt_moment_.clone();
		var linebreak_index_ = 0;

		var result_html_ = "";

		for(var day_index_= 0; day_index_ <= day_count_; ++day_index_){
			if(linebreak_index_ == 0){
				result_html_ += '<div class="row row-day">';
			}

			var target_yyyymm_num_ = parseInt(target_moment_.format("YYYYMM"));
			var target_yyyymm_day_num_ = target_moment_.format("E");
			var is_holiday_ = (target_yyyymm_day_num_ == 6 || target_yyyymm_day_num_ == 7);
			var col_class_name_ = "";

			if(target_yyyymm_num_ < yyyymm_num_){
				col_class_name_ = "before-month";
			}else if(target_yyyymm_num_ > yyyymm_num_){
				col_class_name_ = "after-month";
			}

			if(is_holiday_){
				col_class_name_ += " holiday";	
			}

			result_html_ += '<div class="col '+col_class_name_+'" data-day-yyyymmdd="'+target_moment_.format("YYYYMMDD")+'">';

			if(this._options['day_selectable']){
				result_html_ += '<a href="#" class="day-label" data-selectable-day-yyyymmdd="'+target_moment_.format("YYYYMMDD")+'">'+target_moment_.format("DD")+"</a>";
			}else{
				result_html_ += target_moment_.format("DD");
			}

			result_html_ += '<div class="schedule-dot-list"></div>';
			
			
			result_html_ += '</div>';

			if(linebreak_index_ == 6){
				result_html_ += '</div>';
				linebreak_index_ = 0;
			}else{
				++linebreak_index_;
			}

			target_moment_.add(1, "days");
		}

		this._body_frame.html(result_html_);

		this._schedule_list(function(schedule_list_){
			var that_ = this;
			$.each(schedule_list_, function(yyyymmdd_, schedule_data_){
				var schedule_dot_list_el_ = that_._body_frame.find("[data-day-yyyymmdd='"+yyyymmdd_+"'] > .schedule-dot-list");

				$.each(schedule_data_, function(){
					var schedule_dot_item_ = $('<span class="schedule-dot-item" data-schedule-id="'+this['ID']+'"></span>'); 
					schedule_dot_list_el_.append(schedule_dot_item_);
					that_._options['schedule_dot_item_render'].apply(that_, [schedule_dot_item_, this]);
				});
				
			});
		});

		if(this._options['day_selectable']){
			this._body_frame.find("[data-selectable-day-yyyymmdd]").click($.proxy(function(event_){
				var day_yyyymmdd_ = $(event_.currentTarget);
				var yyyymmdd_ = day_yyyymmdd_.attr("data-selectable-day-yyyymmdd");
				this._options['callback_selected_day'].apply(this, [yyyymmdd_]);
				return false;
			}, this));
		}
	});

	$.fn.pb_calendar = (function(options_){
		var module_ = this.data('pb-calendar');
		if(module_) return module_;
		return new _pb_calendar(this, options_);
	});

});