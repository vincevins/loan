async function getData() {
  const url = "http://localhost/casestudy-loan/loan/controller/overdue.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const result = await response.json();
    console.log('over due: ',result);
  } catch (error) {
    console.error(error.message);
  }
}
getData();