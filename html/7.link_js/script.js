function showDetails() {
    // Get input values
    let firstName = document.getElementById("firstName").value;
    let lastName = document.getElementById("lastName").value;
    
  
    // Greet user
    document.getElementById("greeting").innerText = `Hello, ${firstName} ${lastName}!`;
  
    // Show average weeks in a human life
    const avgLifespanYears = 72;
    const weeksInYear = 52;
    const avgWeeks = avgLifespanYears * weeksInYear;
    document.getElementById("lifespan").innerText = `Average human lifespan is approximately ${avgWeeks} weeks.`;
  
    // Show time of day
    const currentHour = new Date().getHours();
    let timeOfDay = "";
  
    if (currentHour < 12) {
      timeOfDay = "morning";
    } else if (currentHour < 18) {
      timeOfDay = "afternoon";
    } else {
      timeOfDay = "night";
    }
    
    document.getElementById("timeofday").innerText = `Good ${timeOfDay}, ${firstName}!`;
    alert("Welcome to the page");
}
  