class Errors {
  constructor() {
    this.errors = {};
  }

  //populates the errors returned from server in the 'errors' object
  recordErrors(errors) {
    this.errors = errors;
    // console.log(this.errors);
  }

  //checks if the errors object has any error [to disable the create button if there is one]
  hasAnyError() {
    return Object.keys(this.errors).length > 0; //returns true if the 'errors' object has any 'key' [object:{key:value}]
  }

  //checks if any particular field has error [to display the error message only if there is an error]
  hasError(field_name) {
    return this.errors.hasOwnProperty(field_name); //hasOwnProperty() returns true if the object has the given property name i.e. key
  }

  // returns the error message (if any) for particular field
  getErrorMessage(field_name) {
    if (this.errors[field_name]) {
      return this.errors[field_name][0];
    }
  }

  // clears the error message as soon as user starts typing
  clearError(field_name) {
    delete this.errors[field_name];
  }

}

export default Errors;
