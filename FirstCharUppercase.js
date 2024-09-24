function isFirstCharUppercase(str) {
  // Check if the first character is uppercase
  return /^[A-Z]/.test(str);
}

// Test the function
const testString = "Hello World";
console.log(isFirstCharUppercase(testString)); // true
