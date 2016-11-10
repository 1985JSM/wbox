/*!
 * sMenu - v0.1 - 2015-11-09
 * http://archive.sdn21.com/archive/js/skeyboard/
 * Copyright (c) 2015 Ma Yong Min
 * Licensed MIT (http://archive.sdn21.com/archive/js/skeyboard/LICENSE-MIT)
 */

(function($) {
	$.sKeyboard = {
		version: '0.1',
		curr: 0
	};

	// sKeyboard
	$.fn.sKeyboard = function(options) {
		var opt = $.extend(true, {}, $.fn.sKeyboard.defaults, options);

		/**
		* 자판 배열
		*/

		// 숫자
		var num_arr = new Array();
		num_arr = "1|2|3|4|5|6|7|8|9|0".split("|");

		// 문자 (영문/국문/기호)
		var key_arr = new Array();
		key_arr["english"] = new Array();
		key_arr["korean"] = new Array();
		key_arr["symbol"] = new Array();

		// 영문 > 소문자			
		key_arr["english"]["normal"] = [
			[ "q", "w", "e", "r", "t", "y", "u", "i", "o", "p" ],
			[ "a", "s", "d", "f", "g", "h", "j", "k", "l" ],
			[ "z", "x", "c", "v", "b", "n", "m" ]
		];

		// 영문 > 대문자
		key_arr["english"]["shift"] = [
			[ "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P" ],
			[ "A", "S", "D", "F", "G", "H", "J", "K", "L" ],
			[ "Z", "X", "C", "V", "B", "N", "M" ]
		];

		// 국문 > 기본
		key_arr["korean"]["normal"] = [
			[ "ㅂ", "ㅈ", "ㄷ", "ㄱ", "ㅅ", "ㅛ", "ㅕ", "ㅑ", "ㅐ", "ㅔ" ],
			[ "ㅁ", "ㄴ", "ㅇ", "ㄹ", "ㅎ", "ㅗ", "ㅓ", "ㅏ", "ㅣ" ],
			[ "ㅋ", "ㅌ", "ㅊ", "ㅍ", "ㅠ", "ㅜ", "ㅡ" ]
		];

		// 국문 > 쌍자음/모음
		key_arr["korean"]["shift"] = [
			[ "ㅃ", "ㅉ", "ㄸ", "ㄲ", "ㅆ", "ㅛ", "ㅕ", "ㅑ", "ㅒ", "ㅖ" ],
			[ "ㅁ", "ㄴ", "ㅇ", "ㄹ", "ㅎ", "ㅗ", "ㅓ", "ㅏ", "ㅣ" ],
			[ "ㅋ", "ㅌ", "ㅊ", "ㅍ", "ㅠ", "ㅜ", "ㅡ" ]
		];

		// 기호 > 소문자			
		key_arr["symbol"]["normal"] = [			
			[ "!", "@", "#", "~", "/", "^", "&", "*", "(", ")" ],
			[ "_", "\\", "|", "<", ">", "{", "}", "[", "]" ],			
			[ "-", "'", "\"", ":", ";", ",", "?" ]
		];

		// 기호 > 대문자
		key_arr["symbol"]["shift"] = [
			[ "+", "×", "÷", "=", "%", "₩", "♤", "♡", "☆", "♧" ],			
			[ "○", "●", "□", "■", "◇", "$", "€", "£", "¥" ],
			[ "°", "※", "¤", "《", "》", "¡", "¿" ]
		];

		/**
		* 한글 초/중/종성 배열
		*/		
			
		var code_arr = new Array();

		// 초성			
		code_arr["initial"] = [
			"ㄱ", "ㄲ",
			"ㄴ",
			"ㄷ", "ㄸ",
			"ㄹ",
			"ㅁ",
			"ㅂ", "ㅃ",
			"ㅅ", "ㅆ",
			"ㅇ",
			"ㅈ", "ㅉ",
			"ㅊ",
			"ㅋ",
			"ㅌ",
			"ㅍ",
			"ㅎ"
		];

		// 중성
		code_arr["medial"] = [
			"ㅏ", "ㅐ",
			"ㅑ", "ㅒ",
			"ㅓ", "ㅔ",
			"ㅕ", "ㅖ",
			"ㅗ", "ㅘ", "ㅙ", "ㅚ",
			"ㅛ",
			"ㅜ", "ㅝ", "ㅞ", "ㅟ", 
			"ㅠ",
			"ㅡ", "ㅢ",
			"ㅣ"
		];

		// 종성
		code_arr["final"] = [
			"",
			"ㄱ", "ㄲ", "ㄳ",
			"ㄴ", "ㄵ", "ㄶ",
			"ㄷ",
			"ㄹ", "ㄺ", "ㄻ", "ㄼ", "ㄽ", "ㄾ", "ㄿ", "ㅀ",
			"ㅁ", 
			"ㅂ", "ㅄ",
			"ㅅ", "ㅆ",
			"ㅇ",
			"ㅈ",
			"ㅊ",
			"ㅋ",
			"ㅌ",
			"ㅍ",
			"ㅎ"
		]; 

		/**
		* 한글 조합 배열
		*/
		var combi_arr = new Array();

		// 자음 조합
		combi_arr["consonant"] = [
			[ "ㄳ",		"ㄵ",	"ㄶ",	"ㄺ",	"ㄻ",	"ㄼ",	"ㄽ",	"ㄾ",	"ㄿ",	"ㅀ",	"ㅄ" ],
			[ "ㄱㅅ",	"ㄴㅈ",	"ㄴㅎ",	"ㄹㄱ",	"ㄹㅁ",	"ㄹㅂ",	"ㄹㅅ",	"ㄹㅌ",	"ㄹㅍ",	"ㄹㅎ",	"ㅄ" ]
		];

		// 모음 조합
		combi_arr["vowel"] = [
			[ "ㅘ",		"ㅙ",	"ㅚ",	"ㅝ",	"ㅞ",	"ㅟ",	"ㅢ" ],
			[ "ㅗㅏ",	"ㅗㅐ",	"ㅗㅣ",	"ㅜㅓ",	"ㅜㅔ",	"ㅜㅣ",	"ㅡㅣ" ]
		];

		// 한글 자모 구간
		var section_arr = new Array();
		section_arr["first_consonant"]	= "ㄱ".charCodeAt(0);
		section_arr["last_consonant"]	= "ㅎ".charCodeAt(0);
		section_arr["first_vowel"]		= "ㅏ".charCodeAt(0);
		section_arr["last_vowel"]		= "ㅣ".charCodeAt(0);

		/**
		* common setting
		*/
		var obj_layer = null;
		var obj_button = null;	
		var obj_input = null;

		var character_mode = "english";
		var letter_mode = "normal";

		var flag_successive_remove = false;

		/**
		* common method
		*/

		// open keyboard layer
		var openKeyboardLayer = function(obj) {		
			obj_input = $(obj);
			flag_successive_remove = true;
			//obj_layer.addClass("open").show();
			obj_layer.addClass("open").animate({bottom : "0"}, 250);
		}

		// close keyboard layer
		var closeKeyboardLayer = function() {
			obj_input.focus();
			//obj_layer.removeClass("open").hide();
			obj_layer.removeClass("open").animate({bottom : "-450px"}, 250);
		}

		// make keyboard layer
		var makeKeyboardLayer = function() {

			/* content */

			// number
			var layer_content = "<ul class=\"sKeyboard-number-area\">";
			for(var i = 0 ; i < num_arr.length ; i++) {
				layer_content += "<li><button type=\"button\" class=\"sKeyboard-number\">" + num_arr[i] + "</button></li>";
			}					
			layer_content += "</ul>";
			
			for(var i = 0 ; i < 3 ; i++) {
				var no = i * 1 + 1;
				layer_content += "<ul class=\"sKeyboard-character-area sKeyboard-character-area" + no + "\">";

				if(i == 2) {
					layer_content += "<li class=\"sKeyboard-shift\"><button type=\"button\" class=\"sKeyboard-shift\"><i class=\"fa fa-arrow-up\"></i></button></li>";
				}

				for(var j = 0 ; j < key_arr[character_mode]["normal"][i].length ; j++) {
					layer_content += "<li><button type=\"button\" class=\"sKeyboard-character\">" + key_arr[character_mode]["normal"][i][j] + "</button></li>";
				}
				
				if(i == 2) {
					layer_content += "<li class=\"sKeyboard-backspace\"><button type=\"button\" class=\"sKeyboard-backspace\"><i class=\"fa fa-arrow-left\"></i></button></li>";
				}

				layer_content += "</ul>";
			}

			// control
			layer_content += "<ul class=\"sKeyboard-control-area\">";
			layer_content += "<li class=\"sKeyboard-symbol\"><button type=\"button\" class=\"sKeyboard-symbol\">기호</button></li>";
			layer_content += "<li class=\"sKeyboard-switch\"><button type=\"button\" class=\"sKeyboard-switch\">한영</button></li>";
			layer_content += "<li class=\"sKeyboard-spacebar\"><button type=\"button\" class=\"sKeyboard-spacebar\">Spacebar</button></li>";
			layer_content += "<li><button type=\"button\" class=\"sKeyboard-character\">.</button></li>";
			layer_content += "<li class=\"sKeyboard-enter\"><button type=\"button\" class=\"sKeyboard-enter\">Enter</button></li>";
			
			layer_content += "</ul>";

			/* object */
			$obj_layer = $("<div />");
			$obj_layer.attr("id", "sKeyboard-layer").html(layer_content).appendTo("body");
		
			obj_layer = $("#sKeyboard-layer");
			obj_button = $("button", obj_layer);	
			
			/* binding */
			obj_button.on("click", function() {
				onClickListener(this);
			});
		}

		// on click listener
		var onClickListener = function(obj) {

			obj = $(obj);

			if(obj.hasClass("sKeyboard-shift")) {
				// shift
				if(letter_mode == "shift") {						
					switchKeyboard(character_mode, "normal");
				}
				else {
					switchKeyboard(character_mode, "shift");
				}					
			}
			else if(obj.hasClass("sKeyboard-backspace")) {
				// backspace
				removeLetterWord();
			}
			else if(obj.hasClass("sKeyboard-symbol")) {
				// symbol
				switchKeyboard("symbol", "normal");
			}
			else if(obj.hasClass("sKeyboard-switch")) {
				// switch
				if(character_mode == "english") { 
					switchKeyboard("korean", "normal");
				}
				else  {
					switchKeyboard("english", "normal");
				}
			}
			else if(obj.hasClass("sKeyboard-enter")) {
				// enter
				closeKeyboardLayer();
			}
			else if(obj.hasClass("sKeyboard-spacebar")) {
				// spacebar
				addLetterWord(" ");
			}
			else if(obj.hasClass("sKeyboard-number")) {
				// number
				addLetterWord(obj.text());
			}	
			else if(obj.hasClass("sKeyboard-character")) {
				addLetterWord(obj.text());			
			}
		}

		// make korean by index
		var makeKoreanByIndex = function(i_idx, m_idx, f_idx) {
			var code = ((i_idx * 21) + m_idx) * 28 + f_idx + 0xAC00;
			return String.fromCharCode(code);
		}

		// get initial code
		var getKoreanIndex = function(word) {
			var kor_idx_arr = new Array();
			kor_idx_arr["initial"] = parseInt(((word.charCodeAt(0) - 0xAC00) / 28) / 21);
			kor_idx_arr["medial"] = parseInt(((word.charCodeAt(0) - 0xAC00) / 28) % 21);
			kor_idx_arr["final"] = parseInt((word.charCodeAt(0) - 0xAC00) % 28);

			return kor_idx_arr;
		}

		// switch key
		var switchKeyboard = function(new_character_mode, new_letter_mode) {

			character_mode = new_character_mode;
			letter_mode = new_letter_mode;

			var obj_ul = $("ul.sKeyboard-character-area", obj_layer);				
			for(var i = 0 ; i < obj_ul.length ; i++) {
				var obj_character_button = $("button.sKeyboard-character", obj_ul.eq(i));
				for(var j = 0 ; j < obj_character_button.length ; j++) {
					obj_character_button.eq(j).text(key_arr[character_mode][letter_mode][i][j]);
				}
			}				
		}

		// add letter word
		var addLetterWord = function(word) {

			var text = obj_input.val();
			var word_code = word.charCodeAt(0);

			// 입력한 문자가 한글 자음인지?
			var is_word_consonant = false;				
			if(word_code >= section_arr["first_consonant"] && word_code <= section_arr["last_consonant"]) {
				is_word_consonant = true;
			}

			// 입력한 문자가 한글 모음인지?
			var is_word_vowel = false;
			if(word_code >= section_arr["first_vowel"] && word_code <= section_arr["last_vowel"]) {
				is_word_vowel = true;
			}

			
			if((is_word_consonant || is_word_vowel) && text) {				

				// 마지막 문자
				var last_char = text.substring(text.length - 1);
				var last_char_code = last_char.charCodeAt(0);

				var i_idx = -1;
				var m_idx = -1;
				var f_idx = -1;

				
				if(last_char_code >= section_arr["first_consonant"] && last_char_code <= section_arr["last_consonant"]) {
					// 마지막 문자가 한글 초성(자음)인 경우
					
					if(is_word_vowel) {						
						// 입력한 문자가 모음일 경우 => 초성(자음) + 중성(모음)
						i_idx = code_arr["initial"].indexOf(last_char);
						m_idx = code_arr["medial"].indexOf(word);

						text = text.substring(0, text.length - 1);
						word = makeKoreanByIndex(i_idx, m_idx, 0);
					}
				}				
				else if(last_char_code >= 0xAC00 && last_char_code <= 0xAC00 + 0x2BA4) {

					// 마지막 문자가 한글 조합형일 경우
					var kor_idx_arr = getKoreanIndex(last_char);
					var i_idx = kor_idx_arr["initial"];
					var m_idx = kor_idx_arr["medial"];
					var f_idx = kor_idx_arr["final"];

					if(f_idx) {
						// 마지막 문자가 초성 + 중성 + 종성 조합인 경우

						if(is_word_consonant) {

							// 입력한 문자가 자음일 경우
							var final_word = code_arr["final"][f_idx] + word;
							var combi_idx = combi_arr["consonant"][1].indexOf(final_word);
							if(combi_idx > -1) {
								// 마지막 문자의 종성과 입력한 문자의 조합이 존재할 경우
								var combi_word = combi_arr["consonant"][0][combi_idx];
								f_idx = code_arr["final"].indexOf(combi_word);
								text = text.substring(0, text.length - 1);
								word = makeKoreanByIndex(i_idx, m_idx, f_idx);
							}
						}
						else if(is_word_vowel) {

							// 입력한 문자가 모음일 경우
							var final_word = code_arr["final"][f_idx];
							var combi_idx = combi_arr["consonant"][0].indexOf(final_word);
							if(combi_idx > -1) {
								// 마지막 문자의 종성이 조합문자일 경우
								var combi_word = combi_arr["consonant"][1][combi_idx];
								f_idx = code_arr["final"].indexOf(combi_word[0]);
								final_word = combi_word[1];
							}
							else {
								// 마지막 문자의 종성이 조합 문자가 아닐 경우 => 해당 종성이 다음 음절의 초성으로 전환
								f_idx = 0;
							}

							var new_i_idx = code_arr["initial"].indexOf(final_word);
							if(new_i_idx > -1) {
								var new_m_idx = code_arr["medial"].indexOf(word);
								text = text.substring(0, text.length - 1);
								word = makeKoreanByIndex(i_idx, m_idx, f_idx) + makeKoreanByIndex(new_i_idx, new_m_idx, 0);
							}
						}
					}
					else {
						// 마지막 문자가 초성 + 중성 조합인 경우

						if(is_word_consonant) {
							// 입력한 문자가 자음일 경우 => 초성(자음) + 중성(모음) + 종성(자음)
							f_idx = code_arr["final"].indexOf(word);

							text = text.substring(0, text.length - 1);
							word = makeKoreanByIndex(i_idx, m_idx, f_idx);
						}
						else if(is_word_vowel) {
							
							// 입력한 문자가 모음일 경우 => 초성(자음) + 중성(모음) + 중성(모음) => 초성(자음) + 중성(모음 조합)
							var medial_word = code_arr["medial"][m_idx] + word;
							var combi_idx = combi_arr["vowel"][1].indexOf(medial_word);
							if(combi_idx > -1) {
								var combi_word = combi_arr["vowel"][0][combi_idx];
								m_idx = code_arr["medial"].indexOf(combi_word);

								text = text.substring(0, text.length - 1);
								word = makeKoreanByIndex(i_idx, m_idx, f_idx);
							}
						}
					}
				}			
			}				

			obj_input.val(text + word).focus();

			// unshift
			if(letter_mode == "shift") {
				switchKeyboard(character_mode, "normal");
			}

			// 연속 삭제 모드 해제
			flag_successive_remove = false;
		}

		// remove letter word
		var removeLetterWord = function() {

			var text = obj_input.val();		
			var word = "";
			var or_length = text.length;

			if(text) {
				// 마지막 문자
				var last_char = text.substring(text.length - 1);
				var last_char_code = last_char.charCodeAt(0);

				// 마지막 액션
				if(flag_successive_remove) {
					// 연속으로 삭제하는 경우
					text = text.substring(0, text.length - 1);
				}
				else if(last_char_code >= 0xAC00 && last_char_code <= 0xAC00 + 0x2BA4) {

					// 마지막 문자가 한글 조합 문자인 경우
					var kor_idx_arr = getKoreanIndex(last_char);
					var i_idx = kor_idx_arr["initial"];
					var m_idx = kor_idx_arr["medial"];
					var f_idx = kor_idx_arr["final"];

					if(f_idx) {
						// 마지막 문자가 초성 + 중성 + 종성 조합인 경우
						var final_word = code_arr["final"][f_idx];
						var combi_idx = combi_arr["consonant"][0].indexOf(final_word);
						if(combi_idx > -1) {
							// 마지막 문자의 종성이 조합 문자인 경우
							var combi_word = combi_arr["consonant"][1][combi_idx];
							f_idx = code_arr["final"].indexOf(combi_word[0]);

							text = text.substring(0, text.length - 1);
							word = makeKoreanByIndex(i_idx, m_idx, f_idx);
						}
						else {
							// 마지막 문자의 종성이 조합 문자가 아닌 경우
							text = text.substring(0, text.length - 1);
							word = makeKoreanByIndex(i_idx, m_idx, 0);
						}
					}
					else {
						// 마지막 문자가 초성 + 중성 조합인 경우
						var medial_word = code_arr["medial"][m_idx];
						var combi_idx = combi_arr["vowel"][0].indexOf(medial_word);
						if(combi_idx > -1) {
							// 마지막 문자의 중성이 조합 문자인 경우
							var combi_word = combi_arr["vowel"][1][combi_idx];
							m_idx = code_arr["medial"].indexOf(combi_word[0]);

							text = text.substring(0, text.length - 1);
							word = makeKoreanByIndex(i_idx, m_idx, 0);
						}
						else {
							// 마지막 문자의 중성이 조합 문자가 아닌 경우
							text = text.substring(0, text.length - 1);
							word = code_arr["initial"][i_idx];
						}
					}
				}
				else {
					// 마지막 문자가 한글 조합 문자가 아닌 경우
					text = text.substring(0, text.length - 1);
				}
			}

			var new_text = text + word;
			obj_input.val(new_text).focus();

			if(new_text.length < or_length) {
				flag_successive_remove = true;
			}
		}

		this.each(function() {

			/**
			* setting
			*/			
			
			// charactor			
			if(opt.default_mode == "korean") {
				character_mode = "korean";
			}
			else {
				character_mode = "english";
			}
			
			/**
			* method
			*/
			var init = function() {
			
				if(obj_layer == null) {
					makeKeyboardLayer();
				}
			}


			
			/**
			* binding
			*/
			$(this).on("focusin", function() {
				
				if(!obj_layer.hasClass("open") || $(this).attr("name") != obj_input.attr("name")) {
					openKeyboardLayer(this);
				}
			});

			/**
			* run
			*/
			init();
		});

		return this;
	};

	/**
	* default option
	*/
	$.fn.sKeyboard.defaults = {
		theme			: "basic",			

		default_mode	: "english"
				
	};
})(jQuery);