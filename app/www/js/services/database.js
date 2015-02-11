whowins
.factory("battlebucket", function(){

	var db;
	var data;

	var openDB = function(){
		db = window.openDatabase("whowins", "1.0", "whowins", 1000000);
	}
	var execute = function(executeThis, callback){
		db.transaction(executeThis, db_err, callback);
	};
	var select = function(query, callback){
		db.transaction(function(tx){
			tx.executeSql(query, [], function(tx, rs){
				var results = new Array();
				var len = rs.rows.length;
				for (var i = 0; i < len; i++){
					results[i] = rs.rows.item(i);
				}
   				callback(results);
			})
		});
	};
	var db_err = function(tx, err){
		console.info("Error connecting to database...");
		console.info(tx);
	};


	// events:
	var db_createEventTable = function(tx){
		tx.executeSql("CREATE TABLE IF NOT EXISTS events (id, question)");
	};
	var db_truncateEvents = function(tx){
		tx.executeSql("DROP TABLE events");
	};
	var db_insertEvents = function(tx){
		var questions = data;
		questions.forEach(function(q){
			tx.executeSql("INSERT INTO events (id, question) VALUES ("+q.id+", '"+q.question+"')");
			// we can make this better! ;)
		});
	}


});


/*



	var db_createSyncTable = function(tx){
		tx.executeSql("CREATE TABLE IF NOT EXISTS syncData (object, id, data, sync)");
	}
	// visits:
	var db_insertVisit = function(tx){
		var visit = data.serialize();
		tx.executeSql("INSERT INTO syncData (object, id, data, sync) VALUES ('visit', '"+data.empresa_cnpj+"', '"+visit+"', 0);");
	}
	var db_insertAssociate = function(tx){
		var ass = data.serialize();
		tx.executeSql("INSERT INTO syncData (object, id, data, sync) VALUES ('associate', '"+data.cpf+"', '"+ass+"', 0);");
	}
	var db_insertCompany = function(tx){
		var co = data.serialize();
		tx.executeSql("INSERT INTO syncData (object, id, data, sync) VALUES ('company', '"+data.cnpj+"', '"+co+"', 0);");
	}


	var db_selectVisitsToSync = function(callback){
		select("SELECT * FROM syncData WHERE object = 'visit' AND sync = 0", callback);
	};
	var db_selectCompaniesToSync = function(callback){
		select("SELECT * FROM syncData WHERE object = 'company' AND sync = 0", callback);
	};
	var db_selectAssociatesToSync = function(callback){
		select("SELECT * FROM syncData WHERE object = 'associate' AND sync = 0", callback);
	};

	var setSyncObject = function(tx){
		var obj = data;
		tx.executeSql("UPDATE syncData SET sync = 1 WHERE object = '"+data.object+"' AND id = '"+data.id+"'");
	}


	return {
		start: function() {
			openDb();
		},
		addWorkers: function(ws, callback){
			data = ws;
			execute(db_truncateWorkers);
			execute(db_createWorkerTable);
			execute(db_insertWorkers, callback);
		},
		getWorkers: function(callback){
			db_selectWorkers(callback);
		},
		startSyncTable: function(){
			execute(db_createSyncTable);
		},
		insertVisit: function(visit, callback){
			data = visit;
			execute(db_createSyncTable);
			execute(db_insertVisit, callback);
		},
		insertAssociate: function(associate, callback){
			data = associate;
			execute(db_createSyncTable);
			execute(db_insertAssociate, callback);
		},
		insertCompany: function(company, callback){
			data = company;
			execute(db_createSyncTable);
			execute(db_insertCompany, callback);
		},
		getVisits: function(callback){
			db_selectVisitsToSync(callback);
		},
		getCompanies: function(callback){
			db_selectCompaniesToSync(callback);
		},
		getAssociates: function(callback){
			db_selectAssociatesToSync(callback);
		},

		syncObject: function(obj){
			data = obj;
			execute(setSyncObject);
		}

	}

});
 */