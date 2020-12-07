

function fnReportAction( member_id, target_id ){
  
    ReportPrompt.open({
      title: 'Report User',
      message: 'Please provide description of the user\'s action.',
      okText: 'Submit',
      onok: () => {
        var report_content = document.getElementById( "form-report-text-id" ).value;
        if( report_content == "" )
          return;
        $.ajax({
          url: 'inc/report_acc.inc.php',
          type: 'POST',
          data: {
              member_id: member_id,
              target_id: target_id,
              content: report_content
          },
          success: function( response ) {
            document.getElementById( "report-account-button" ).remove();
          }
        });
      }
    });
}

function fnReviewAction(){
  
    ReviewPrompt.open({
      title: 'Review User',
      message: 'Please provide review of your experience along with rating.',
      okText: 'Submit',
      onok: () => {
        alert("Review Submitted.");
      }
    });
}


document.getElementById('add-review-button').addEventListener('click',fnReviewAction, false);