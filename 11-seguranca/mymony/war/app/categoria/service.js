angular.module('mymony')
  .service('CategoriaService', service);

service.$inject = ['$http', '$q'];
function service($http, $q) {
  var resource;

  return {
    setResource: setResource,
    index: index,
    get: getRecord,
    create: createRecord,
    delete: deleteRecord,
  };

  function setResource(path) {
    resource = path + '/';
  }

  function index() {
    var request = $http({
      url: resource + 'index',
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      data: serialize({}),
    });

    return createPromise(request, true);
  }

  function getRecord(id, message) {
    var url = resource + id;
    if (message) {
      url = url + '/' + message;
    }
    var request = $http.get(url);

    return createPromise(request, true);
  }

  function createRecord(data) {
    var request = $http({
      url: resource + (data.id ? data.id : ''),
      method: data.id ? 'PUT' : 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      data: serialize(data),
    });

    return createPromise(request);
  }

  function deleteRecord(ids) {
    var request = $http.delete(resource + ids);

    return createPromise(request);
  }

  function createPromise(request, getData) {
    var defer = $q.defer();

    request.then(
      function success(response) {
        if (getData) {
          defer.resolve(response.data);
        } else {
          defer.resolve(response);
        }
      },

      function error(response) {
        defer.reject(response);
      }
    );

    return defer.promise;
  }

  function serialize(data) {
    // If this is not an object, defer to native stringification.
    if (!angular.isObject(data)) {
      return (!data ? '' : data.toString());
    }

    var buffer = [];

    // Serialize each key in the object.
    for (var name in data) {
      if (!data.hasOwnProperty(name)) {
        continue;
      }

      var value = data[name];
      buffer.push(encodeURIComponent(name) + '=' + encodeURIComponent(!value ? '' : value));
    }

    // Serialize the buffer and clean it up for transportation.
    return buffer.join('&').replace(/%20/g, '+');
  }

}
