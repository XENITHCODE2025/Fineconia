export default {
  plugins: ["html"],
  extends: ["eslint:recommended"],
  env: {
    browser: true,
    es2021: true
  },
  parserOptions: {
    ecmaVersion: "latest",
    sourceType: "module"
  },
  rules: {
    semi: ["error", "always"],
    quotes: ["error", "double"]
  }
};

