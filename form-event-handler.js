

function fnReportAction(){
  
    ReportPrompt.open({
      title: 'Report User',
      message: 'Please provide description of the user\'s action.',
      okText: 'Submit',
      onok: () => {
        alert("Report Submitted.");
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



document.getElementById('report-account-button').addEventListener('click',fnReportAction, false);

document.getElementById('add-review-button').addEventListener('click',fnReviewAction, false);