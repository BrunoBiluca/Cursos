using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using UnityEngine;

namespace Assets {
    interface ISkeletonState : IEnemyState {
        IEnemyState Handle(Skeleton enemy, Transform playerObj);
    }
}
