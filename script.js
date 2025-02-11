// script.js

/***************************************
 * 1) FLAG TOGGLING
 * When a user clicks a flag icon,
 * we toggle its "active" class,
 * which you can style in CSS to 
 * change color/appearance.
 ***************************************/
function toggleFlag(flagElement) {
  // "flag-active" is a CSS class you might define in style.css
  // e.g., .flag-active { color: red; }
  flagElement.classList.toggle("flag-active");
}

/***************************************
 * 2) TASK TREE: BASIC DRAWING/DEMO
 * This code assumes you have a <canvas>
 * in project.php with id="taskTreeCanvas".
 * We draw placeholder boxes & lines.
 ***************************************/
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("taskTreeCanvas");
  if (!canvas) return; // Only run this if the canvas is on the page

  // Set size—adjust as needed or set via HTML/CSS
  canvas.width = 800;
  canvas.height = 600;
  const ctx = canvas.getContext("2d");

  // Variables for zoom/pan
  let scale = 1;      // current zoom level
  let offsetX = 0;    // pan offset (x)
  let offsetY = 0;    // pan offset (y)
  let isDragging = false;
  let startX, startY; // track mouse position for dragging

  // Example tasks in a “hard-coded” structure
  // In reality, you could pass these in via JSON or PHP.
  const tasks = [
    { name: "Task 1", x: 100, y: 100 },
    { name: "Task 2", x: 100, y: 220 },
    { name: "Task 3", x: 300, y: 100 }
    // etc...
  ];
  // Example connections (from -> to)
  const connections = [
    [0, 1],  // Task1 -> Task2
    [0, 2]   // Task1 -> Task3
  ];

  /***************************************
   * DRAW THE TREE
   ***************************************/
  function drawTree() {
    // clear canvas
    ctx.save();
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // apply current pan + zoom
    ctx.translate(offsetX, offsetY);
    ctx.scale(scale, scale);

    // Draw connections
    ctx.strokeStyle = "#555";
    ctx.lineWidth = 2;
    connections.forEach(conn => {
      const from = tasks[conn[0]];
      const to   = tasks[conn[1]];
      ctx.beginPath();
      ctx.moveTo(from.x + 40, from.y + 25); // approximate center-right
      ctx.lineTo(to.x + 40, to.y + 25);
      ctx.stroke();
    });

    // Draw each task as a rectangle
    tasks.forEach(task => {
      // background box
      ctx.fillStyle = "#ddd";
      ctx.fillRect(task.x, task.y, 80, 50);

      // text label
      ctx.fillStyle = "#333";
      ctx.font = "14px sans-serif";
      ctx.fillText(task.name, task.x + 10, task.y + 28);
    });

    ctx.restore();
  }

  /***************************************
   * ZOOM (with the mouse wheel)
   ***************************************/
  canvas.addEventListener("wheel", e => {
    e.preventDefault();
    // “wheel” determines zoom direction
    const zoomFactor = e.deltaY < 0 ? 1.1 : 0.9;
    scale *= zoomFactor;
    // Optionally limit how far we can zoom in/out
    if (scale < 0.2) scale = 0.2;
    if (scale > 5)   scale = 5;
    drawTree();
  });

  /***************************************
   * PAN (with mouse drag)
   ***************************************/
  canvas.addEventListener("mousedown", e => {
    isDragging = true;
    // record offset between mouse and (offsetX/offsetY)
    startX = e.clientX - offsetX;
    startY = e.clientY - offsetY;
  });

  canvas.addEventListener("mousemove", e => {
    if (!isDragging) return;
    offsetX = e.clientX - startX;
    offsetY = e.clientY - startY;
    drawTree();
  });

  canvas.addEventListener("mouseup", () => {
    isDragging = false;
  });

  // If you want to also stop dragging on leaving the canvas:
  canvas.addEventListener("mouseleave", () => {
    isDragging = false;
  });

  // INITIAL DRAW
  drawTree();
});
