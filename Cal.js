

let expression = "";

function add(value) {
    const lastChar = expression.slice(-1);
    
    // Prevent multiple operators in a row
    if ("+-*/".includes(lastChar) && "+-*/".includes(value)) {
        return;
    }

    // Prevent starting with an operator (except '-')
    if (expression === "" && "+*/".includes(value)) {
        return;
    }

    // Prevent multiple decimal points in a single number
    const parts = expression.split(/[\+\-\*\/]/);
    const lastPart = parts[parts.length - 1];
    if (value === "." && lastPart.includes(".")) {
        return;
    }

    expression += value;
    document.getElementById("display").value = expression;
}

function calculate() {
    try {
        // Prevent evaluation if last character is an operator
        if ("+-*/".includes(expression.slice(-1))) {
            alert("Invalid Expression: Cannot end with an operator.");
            return;
        }

        document.getElementById("display").value = eval(expression);
        expression = document.getElementById("display").value;
    } catch (e) {
        alert("Invalid Expression");
    }
}

function clearInput() {
    if (confirm("Are you sure you want to clear the input?")) {
        expression = "";
        document.getElementById("display").value = "";
    }
}
/*function clearInput() {
   // expression = "";
   // document.getElementById("display").value = "";
} */

