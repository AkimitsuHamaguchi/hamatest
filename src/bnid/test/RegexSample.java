package bnid.test;

import java.util.HashMap;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class RegexSample {
	private static final HashMap<String, String> _SEARCH_PATTERN = new HashMap<String, String>();
	static{
		_SEARCH_PATTERN.put("kana_extra", 	"^[\\p{InHalfwidthAndFullwidthForms}]+$");
		_SEARCH_PATTERN.put("kana", 			"^[\\p{InKatakana}\\p{InHalfwidthAndFullwidthForms}]+$");
		_SEARCH_PATTERN.put("name", 			"^[\\p{InHiragana}\\p{InKatakana}\\p{InCjkUnifiedIdeographs}\\p{InHalfwidthAndFullwidthForms}\\p{InBasicLatin}々〇〻]+$");
		_SEARCH_PATTERN.put("zip", 				"^\\d{3,3}-?\\d{4,4}$");
		_SEARCH_PATTERN.put("tel", 				"^\\(?0(([1-9]{1}\\)?-?\\d{4})|([1-9]{2}\\)?-?\\d{3})|(\\d{3}\\)?-?\\d{2})|([1-9]{4}\\)?-?\\d{1})|(\\d{2}\\)?-?\\d{4}))( |-)?\\d{4}$");
		
	}
	
	 public static void main(String[] args) {
		 if ( args == null || args.length < 2){
			 throw new RuntimeException("引数が足りません");
		 }

		 //判定する文字列
		 String str = args[0];

		 //判定するパターン
		 String searchpattern = null;
		 if(_SEARCH_PATTERN.get(args[1]) != null){
			 searchpattern = _SEARCH_PATTERN.get(args[1]);
		 }else{
			 throw new RuntimeException("引数が間違ってます");
		 }
		 //判定するパターンを生成
		 Pattern p = Pattern.compile(searchpattern);
		 Matcher m = p.matcher(str);
   
		 //画面表示
		 System.out.println(m.find());

	 }

}
