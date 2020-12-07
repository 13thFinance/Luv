

function fnReportAction( member_id, target_id ){
  
    ReportPrompt.open({
      title: 'Report User',
      message: 'Please provide description of the user\'s action.',
      okText: 'Submit',
      onok: () => {
        var report_content = document.getElementById( "form-report-text-id" ).value;
        if( report_content == "" ) {
          alert("Report not submitted. Please provide a reason for the report.");
          return;
        }
        $.ajax({
          url: 'inc/report_acc.inc.php',
          type: 'POST',
          data: {
              member_id: member_id,
              target_id: target_id,
              content: report_content
          },
          success: function( response ) {
            alert("Report submitted.");
            location.reload();
          }
        });
      }
    });
}

function fnReviewAction( member_id, target_id ){
  
    ReviewPrompt.open({
      title: 'Review User',
      message: 'Please provide review of your experience along with rating.',
      okText: 'Submit',
      onok: () => {
        var review_content = document.getElementById( "form-review-text-id" ).value;
        var rating = $( "input[type=radio]:checked" )["0"];
        
        if( review_content == "" || rating == undefined ) {
          alert( "Review not submitted. Please provide a 'heart rating' as well as review text.")
          return;
        }
        console.log( member_id );
        console.log( target_id );
        console.log( rating.value );
        console.log( review_content );

        $.ajax({
          url: 'inc/reviews.inc.php',
          type: 'POST',
          data: {
              member_id: member_id,
              target_id: target_id,
              rating: rating.value,
              content: review_content
          },
          success: function( response ) {
            alert("Review submitted.");
            location.reload();
          }
        });
      }
    });
}