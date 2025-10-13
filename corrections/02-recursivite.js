function factorial(n) {
  if (n === 0) {
    return 1;
  }
  return n * factorial(n - 1);
}

console.log('=== Factorielle ===');
console.log(factorial(0));
console.log(factorial(1));
console.log(factorial(5));
console.log(factorial(10));

function fibonacci(n) {
  if (n === 0) return 0;
  if (n === 1) return 1;
  return fibonacci(n - 1) + fibonacci(n - 2);
}

console.log('\n=== Fibonacci ===');
console.log(fibonacci(0));
console.log(fibonacci(1));
console.log(fibonacci(2));
console.log(fibonacci(6));
console.log(fibonacci(10));


function sumArray(arr) {
  if (arr.length === 0) return 0;
  return arr[0] + sumArray(arr.slice(1));
}

console.log('\n=== Somme d\'un tableau ===');
console.log(sumArray([1, 2, 3, 4, 5]));
console.log(sumArray([]));

function power(base, exponent) {
  if (exponent === 0) return 1;
  return base * power(base, exponent - 1);
}

console.log('\n=== Puissance ===');
console.log(power(2, 3));
console.log(power(5, 2));
console.log(power(10, 0));

function reverseString(str) {
  if (str.length <= 1) return str;
  return str[str.length - 1] + reverseString(str.slice(0, -1));
}

console.log('\n=== Inverser une chaîne ===');
console.log(reverseString("hello"));
console.log(reverseString("bonjour"));

