document.getElementById('report-account-button').addEventListener('click', () => {
  Prompt.open({
    title: 'Report User',
    message: 'Please provide description of the user\'s action.',
    okText: 'Submit',
    onok: () => {
      alert("Report Submitted.");
    }
  })
});