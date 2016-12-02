import { Route } from '@angular/router';

export class RouteMerger {
  static instance: RouteMerger;
  static isCreating: boolean = false;

  constructor() {
    if (!RouteMerger.isCreating) {
      throw new Error("Call RouteMerger.getInstance() instead.");
    }
  }

  static getInstance() {
    if (RouteMerger.instance == null) {
      RouteMerger.isCreating = true;
      RouteMerger.instance = new RouteMerger();
      RouteMerger.isCreating = false;
    }

    return RouteMerger.instance;
  }

  merge(BaseRoutes: Route[], OverriddenRoutes: Route[]) {
    var MergedRoutes = BaseRoutes;
    var BreakException = {};
    OverriddenRoutes.forEach((OverriddenRoute) => {
      try {
        BaseRoutes.forEach((route, key) => {
          if (OverriddenRoute.path === route.path) {
            MergedRoutes[key] = OverriddenRoute;
            throw BreakException;
          }
        });
        MergedRoutes.push(OverriddenRoute);
      }
      catch (e) {
        if (e !== BreakException) {
          throw e;
        }
      }
    });
    return MergedRoutes;
  }
}