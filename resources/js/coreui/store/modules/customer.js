const state = { config: {} }

function initialState () {
    return { config: {} }
}

const mutations = {
    set (state, { key, value }) {
        _.set(state, key, value)
    },
    reset (state) {
        const s = initialState()
        Object.keys(s).forEach((key) => {
            state[key] = s[key]
        })
    },
}
const actions   = {
    index ({ dispatch, rootState }) {
        return new Promise((resolve, reject) => {
            dispatch('asyncCall', {
                method   : 'get',
                url      : '/bookings/',
                params   : { company_id: rootState.company.activeCompany.id },
                canCommit: false,
            }, { root: true }).then((response) => {
                resolve(response)
            }).catch((err) => {
                reject(err)
            })
        })
    },
    show ({ dispatch }, id) {
        return new Promise((resolve, reject) => {
            dispatch('asyncCall', {
                method   : 'get',
                url      : `/bookings/${id}`,
                canCommit: false,
            }, { root: true }).then((response) => {
                resolve(response)
            }).catch((err) => {
                reject(err)
            })
        })
    },
    store () {},
    update ({ dispatch }, { id, booking }) {
        return new Promise((resolve, reject) => {
            dispatch('asyncCall', {
                method: 'put',
                url   : `/bookings/${id}/update`,
                data  : {
                    order_id   : booking.order_id,
                    customer_id: booking.customer_id,
                    bookable_id: booking.bookable_id,
                    starts_at  : booking.starts_at,
                    ends_at    : booking.ends_at,
                },
                canCommit: false,
            }, { root: true }).then((response) => {
                resolve(response)
            })
                .catch((err) => {
                    this.serverErrors = Object.values(err.response.data.errors)
                    reject(err)
                })
        })
    },
    destroy ({ dispatch }, id) {
        return new Promise((resolve, reject) => {
            dispatch('asyncCall', {
                method   : 'delete',
                url      : `/bookings/${id}`,
                canCommit: false,
            }, { root: true }).then((response) => {
                resolve(response)
            }).catch((err) => {
                reject(err)
            })
        })
    },
}
export default {
    namespaced: true,
    state,
    mutations,
    actions,
}