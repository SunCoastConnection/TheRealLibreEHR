// bind data to view, changes automatically when view changes, listen for data property change

class NFormHolder {
    constructor(key, event,value) {
        this.key = key
        this.event = event
        this.value = value
    }
}


// default identifier is id, key should correspond to ui element class or id
// the default identifier is id
//  use when you have views observing a serializable object, give views a common class and a unique id
//  
class NFormOneWayBindingDataStorage {



    constructor(dataObject, identifier="#", key_suffix="") {
        this.keyValueElementList = []
        this.identifier = identifier
        this.dataObject = dataObject
    }


    initialise() {
        
        const dataObject = this.dataObject
        const identifier = this.identifier

        for (var key in dataObject) {
            const transform_key = this.transformKey(key)
            this.keyValueElementList[`${identifier}${transform_key}`] = dataObject[key]
            this.setObjectValuesToElement()
        }

    }
    getData() {
        return this.dataObject
    }

    refresh() {
        this.setObjectValuesToElement();
    }

    setObjectValuesToElement() {
        const self = this
        const keyValueElementList = this.keyValueElementList
        
        for (var key in keyValueElementList) {
            $(key).text(keyValueElementList[key])
            $(key).val(keyValueElementList[key])
        }
    }

    transformKey(key) {
        return key
    }

    setProperty(key,value) {

        return this
    }


    
}


// NForm data storage stores all the data
// of the elements which are selected by the identifier
// whether it is class or id

class NFormDataStorage {
    
    constructor() {

    }

    setPropertyFromUiEvent(key,value) {
        // do not notify any one
        this[key] = value
    }

    setPropertyFromExternalSource(key,value) {
        // notify the ui
    }
}


// NFormHelperService is a container to store the classname
// which needs to be observed by the nform helper
class NFormHelperService {
    constructor(NClassName) {
        this.NClassName = NClassName
        this.NFormDataStorage = new NFormDataStorage()
    }
}


// NFormHelper lets you bind the data two ways, you just add 
// same class attribute to the element which needed two way binding
// by default it tend to fetch the val() of the input element, if 
// you need to fetch some other properties for example text you can 
// give attribute to parse as textElement in data-nform-source
// it is important to note that
// WHEN YOU GIVE COMMON CLASS TO OBSERVE, MAKE SURE THEY HAVE UNIQUE ID



class NFormHelper {
    
    constructor(NFormHelperService, additionalSelectorList) {
        this.additionalSelectorList = additionalSelectorList

        this.NFormHelperService = NFormHelperService
        this.setUpTwoWayBinding()

    }

    getDataStorage() {
        return this.NFormHelperService.NFormDataStorage
    }

    getCurrentUiValues() {
        const current_ui_values_list = {}
        const className = this.NFormHelperService.NClassName

        $(`.${className}`).each(function() {            
            const id = $(this).attr('id')
            const identifier  = `#${id}`
            current_ui_values_list[identifier] = $(this).val()
        })

        return current_ui_values_list
    }

    initialiseDataStorageWithUiValues(key, value) {
        const dataStorage = this.NFormHelperService.NFormDataStorage
        dataStorage.setPropertyFromUiEvent(key, value)
    }

    setUpTwoWayBinding() {
        // get all elements belonging to group identifiers
        const className = this.NFormHelperService.NClassName
        const dataStorage = this.NFormHelperService.NFormDataStorage
        const self = this
        this.loopThroughClassAndSetupEventListeners(self, className, dataStorage)
    }

    setUpListeners(self, identifier, dataStorage) {
            const initial_value = $(identifier).val()
            self.initialiseDataStorageWithUiValues(identifier, initial_value)

            $(document).on('change', identifier, function(event) {
                event.preventDefault();
                var identification_string =identifier

                // custom identifier is used when you want a custom key in data object
                const custom_identifier = $(identifier).data('nformCustomIdentifier')
                if (custom_identifier != null && custom_identifier != "") {
                    identification_string = custom_identifier
                }
                const value = self.getValueBasedOnFieldType(identifier)
                dataStorage.setPropertyFromUiEvent(identification_string, value)
            });


    }

    loopThroughClassAndSetupEventListeners(self, className, dataStorage) {

        $(`.${className}`).each(function() {            
            const id = $(this).attr('id')
            const identifier  = `#${id}`
            self.setUpListeners(self, identifier, dataStorage)
        })

        const additionalSelectorList = this.additionalSelectorList
        $(additionalSelectorList).each(function(index, el) {
            self.setUpListeners(self, el, dataStorage)
            });

    }

    getValueBasedOnFieldType(identifier) {

        const attributeToParse = $(identifier).data('nformSource')
        if (attributeToParse != "" && attributeToParse != null) {
            return $(identifier).prop(attributeToParse)
        }
        else {
            return $(identifier).val()
        }
    }



}