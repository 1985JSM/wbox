<?
if(!defined('_INPLUS_')) { exit; } 

$oPortfolio = new PortfolioManager();
$oPortfolio->init();

$pk = $oPortfolio->get('pk');
$uid = $oPortfolio->get('uid');
?>

<form name="write_comment_form" method="post" action="./process.html" onsubmit="return submitWriteCommentForm(this)">
<input type="hidden" name="mode" value="insert_comment" />
<input type="hidden" name="sh_code" value="<?=$member['sh_code']?>" />
<input type="hidden" name="page" value="<?=$page?>" />
<input type="hidden" name="query_string" value="<?=$query_string?>" />
<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />


<table class="write_table" border="1">
<colgroup>
<col width="100">
<col width="*">
</colgroup>
<tbody>
<tr>
	<th>작성자</th>
	<td>
		<input type="text" name="cm_name" class="text required" value="" size="40" maxlength="20" title="작성자" />
	</td>			
</tr>
<tr>
	<th>내용</th>
	<td>
		<textarea name="cm_content" class="textarea required" rows="5" cols="40" title="내용"></textarea>
	</td>
</tr>		
</tbody>
</table>

<p class="button">
	<button type="submit" class="sButton primary">등록</button>
	<button type="button" class="sButton active" onclick="closeLayerPopup()">닫기</button>
</p>

</form>