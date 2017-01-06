<?php
use fay\models\tables\ExamAnswers;
use fay\models\tables\ExamExamQuestionAnswerText;
use fay\helpers\HtmlHelper;

$answer = ExamAnswers::model()->fetchRow('question_id = '.$exam_question['question_id']);
$user_answer = ExamExamQuestionAnswerText::model()->fetchRow('exam_question_id = '.$exam_question['id']);
?>
<div class="bd">
	<div class="clearfix exam-question-item">
		<span class="fl"><?php echo $index+1?>、</span>
		<div class="fl"><?php echo $exam_question['question']?></div>
		<span class="fl">（得<?php echo $exam_question['score']?> 分 / 共<?php echo $exam_question['total_score']?> 分）</span>
	</div>
	<ul class="exam-question-answers">
		<li><span class="fl bold mr10">参考答案：</span><?php echo HtmlHelper::encode($answer['answer'])?></li>
		<li><span class="fl bold mr10">用户答案：</span><?php echo HtmlHelper::encode($user_answer['user_answer'])?></li>
	</ul>
</div>