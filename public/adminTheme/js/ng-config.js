DSM = angular.module('DSM', ['ui.select', 'ngSanitize'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
})

DSM.directive("compareTo", function () {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=compareTo"
        },
        link: function (scope, element, attributes, ngModel) {

            ngModel.$validators.compareTo = function (modelValue) {
                return modelValue == scope.otherModelValue;
            };

            scope.$watch("otherModelValue", function () {
                ngModel.$validate();
            });
        }
    };
});

DSM.directive('file', function () {
    return {
        require: "ngModel",
        restrict: 'A',
        link: function ($scope, el, attrs, ngModel) {
            el.bind('change', function (event) {
                var files = event.target.files;
                var file = files[0];

                ngModel.$setViewValue(file);
                $scope.$apply();
            });
        }
    };
});

DSM.filter('comma2decimal', [
    function () { // should be altered to suit your needs
        return function (input) {
            var ret = (input) ? input.toString().trim().replace(",", ".") : null;
            return parseFloat(ret);
        };
    }]);

DSM.filter('decimal2comma', [
    function() {// should be altered to suit your needs
        return function(input) {
            var ret=(input)?input.toString().replace(".",","):null;
            if(ret){
                var decArr=ret.split(",");
                if(decArr.length>1){
                    var dec=decArr[1].length;
                    if(dec===1){ret+="0";}
                }//this is to show prices like 12,20 and not 12,2
            }
            return ret;
        };
    }]);

DSM.directive('price', ['$filter',
    function($filter) {
        return {
            restrict:'A',
            require: 'ngModel',
            link: function(scope, element, attrs, ngModelController) {
                ngModelController.$parsers.push(function(data) {
                    //convert data from view format to model format
                    data=$filter('comma2decimal')(data);
                    return data;
                });

                ngModelController.$formatters.push(function(data) {
                    //convert data from model format to view format

                    data=$filter('decimal2comma')(data);
                    return data;
                });

                element.on('keydown', function (event) {
                    if(!(event.shiftKey && (event.keyCode == 9 || event.keyCode == 35 || event.keyCode == 36 ))) {
                        if (event.shiftKey || event.ctrlKey) {
                            event.preventDefault();
                            return false;
                        }
                    }
                    if (event.which == 188) {
                        // to accept comma
                        return true;
                    } else if (event.which == 64 || event.which == 16) {
                        // to allow numbers
                        return true;
                    } else if (event.which >= 48 && event.which <= 57) {
                        // to allow numbers
                        return true;
                    } else if (event.which >= 96 && event.which <= 105) {
                        // to allow numpad number
                        return true;
                    } else if ([8, 13, 27, 37, 38, 39, 40, 9, 35, 36].indexOf(event.which) > -1) {
                        // to allow backspace, enter, escape, arrows, tab
                        return true;
                    } else {
                        event.preventDefault();
                        // to stop others
                        return false;
                    }
                });
            }
        };
}]);

DSM.directive('validationMessage', function () {
    return {
        restrict: 'A',
        priority: 1000,
        require: '^validationTooltip',
        link: function (scope, element, attr, ctrl) {
            ctrl.$addExpression(attr.ngIf || true);
        }
    }
});

DSM.directive('validationTooltip', function ($timeout) {
    return {
        restrict: 'E',
        transclude: true,
        require: '^form',
        scope: {},
        template: '<span class="label label-danger span1" ng-show="errorCount > 0">?<sup>(<% errorCount %>)</sup></span>',
        controller: function ($scope) {
            var expressions = [];
            $scope.errorCount = 0;

            this.$addExpression = function (expr) {
                expressions.push(expr);
            }
            $scope.$watch(function () {
                var count = 0;
                angular.forEach(expressions, function (expr) {
                    if ($scope.$eval(expr)) {
                        ++count;
                    }
                });
                return count;

            }, function (newVal) {
                $scope.errorCount = newVal;
            });

        },
        link: function (scope, element, attr, formController, transcludeFn) {
            scope.$form = formController;
            scope.target = attr.target;

            transcludeFn(scope, function (clone) {
                var badge = null;
                badge = $('[for=' + attr.target + ']');

                var tooltip = angular.element('<div class="validationMessageTemplate tooltip-danger" />');
                tooltip.append(clone);
                element.append(tooltip);
                $timeout(() => {
                    scope.$field = formController[attr.target];
                    badge.tooltip({
                        html: true,
                        title: clone
                    });
                }, 100);
            });
        }
    }
});