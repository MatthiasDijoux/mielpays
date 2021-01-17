import { apiService } from './apiService'
export const userService = {
    deleteUser
}

let routeUser = '/api/users';

function deleteUser(user) {
    return apiService.get(routeUser + user.id + '/user')
}