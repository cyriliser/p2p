function refreshed() {
  if (window.performance) {
    console.info("window.performance works fine on this browser");
  }
  if (performance.navigation.type == 1) {
    console.info("This page is reloaded");
    return true;
  } else {
    console.info("This page is not reloaded");
    return false;
  }
}

function myreload() {
  window.location.href = window.location.href;
}

document.querySelector("#refresh").addEventListener("click", myreload);

// if (refreshed()) {
//   document.querySelector("#response").textContent = "Refreshed";
// } else {
//   document.querySelector("#response").textContent = "Not Refreshed";
// }
