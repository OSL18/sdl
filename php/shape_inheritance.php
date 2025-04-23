<!DOCTYPE html>
<html>
<head>
  <title>Shape Area Calculator</title>
</head>
<body>
  <h2>Calculate Area of a Shape</h2>
  <form method="post">
    <label>Select Shape:</label><br>
    <input type="radio" name="shape" value="triangle" required onclick="showFields('triangle')"> Triangle<br>
    <input type="radio" name="shape" value="square" onclick="showFields('square')"> Square<br>
    <input type="radio" name="shape" value="circle" onclick="showFields('circle')"> Circle<br><br>

    <div id="triangleFields" style="display:none;">
      Base: <input type="number" name="base" step="any"><br>
      Height: <input type="number" name="height" step="any"><br>
    </div>

    <div id="squareFields" style="display:none;">
      Side: <input type="number" name="side" step="any"><br>
    </div>

    <div id="circleFields" style="display:none;">
      Radius: <input type="number" name="radius" step="any"><br>
    </div>

    <br>
    <input type="submit" name="submit" value="Calculate Area">
  </form>

  <script>
    function showFields(shape) {
      document.getElementById('triangleFields').style.display = 'none';
      document.getElementById('squareFields').style.display = 'none';
      document.getElementById('circleFields').style.display = 'none';

      document.getElementById(shape + 'Fields').style.display = 'block';
    }
  </script>

<?php
abstract class Shape {
  abstract public function area();
}

class Triangle extends Shape {
  private $base, $height;
  public function __construct($b, $h) {
    $this->base = $b;
    $this->height = $h;
  }
  public function area() {
    return 0.5 * $this->base * $this->height;
  }
}

class Square extends Shape {
  private $side;
  public function __construct($s) {
    $this->side = $s;
  }
  public function area() {
    return $this->side * $this->side;
  }
}

class Circle extends Shape {
  private $radius;
  public function __construct($r) {
    $this->radius = $r;
  }
  public function area() {
    return (22/7) * $this->radius * $this->radius;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  $shape = $_POST['shape'];

  switch ($shape) {
    case "triangle":
      $base = $_POST['base'];
      $height = $_POST['height'];
      $obj = new Triangle($base, $height);
      break;

    case "square":
      $side = $_POST['side'];
      $obj = new Square($side);
      break;

    case "circle":
      $radius = $_POST['radius'];
      $obj = new Circle($radius);
      break;
  }

  echo "<h3>Area of the $shape: " . $obj->area() . "</h3>";
}
?>
</body>
</html>
